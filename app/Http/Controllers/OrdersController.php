<?php

namespace App\Http\Controllers;
use App\Constants\OrdersStatus;
use App\Models\Orders;
use App\Models\OrdersLogs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PenawaranHarga;
use App\Models\Kontrak;
use App\Models\Pembayaran;
use App\Models\Pengajuan;
use App\Models\Progress;
use Illuminate\Http\RedirectResponse;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statusIds = $request->query('status_ids', []); // Default to an empty array if no query parameter is provided

        if(empty($statusIds)) {
            $orders = Orders::with('penawaran.pengajuan', 'user.dokumencustomer')->get();
        }
        else {
            $orders = Orders::whereIn('status_order_id',$statusIds)->with('penawaran.pengajuan', 'user.dokumencustomer')->get();
        }

        return view('transaksi.order.index', compact('orders'));
    }

    public function customerIndex(Request $request)
    {
        $statusIds = $request->query('status_ids', []); // Default to an empty array if no query parameter is provided

        if(empty($statusIds)) {
            $orders = Orders::where('user_id', auth()->user()->id)->with('penawaran.pengajuan', 'user.dokumencustomer')->get();
        }
        else {
            $orders = Orders::where('user_id', auth()->user()->id)->whereIn('status_order_id',$statusIds)->with('penawaran.pengajuan', 'user.dokumencustomer')->get();
        }

        return view('transaksi.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($penawaran)
    {
        $order = Orders::where('penawaran_id', $penawaran)->first();
        $penawaran = PenawaranHarga::find($penawaran);

        if ($order) {
            return redirect()->route('admin.pengajuan.index')->with('error', 'Order has been created');
        } elseif ($penawaran->status_id != 2 || $penawaran->pengajuan->status_id != 2) {
            return redirect()->route('admin.pengajuan.index')->with('error', 'Offer not yet accepted');
        }

        return view('transaksi.order.create', compact('penawaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PenawaranHarga $penawaran, Request $request)
    {
        $order = Orders::where('penawaran_id', $penawaran->id)->first();

        if ($order) {
            return redirect()->route('admin.pengajuan.index')->with('error', 'Order has been created');
        } elseif ($penawaran->status_id != 2 || $penawaran->pengajuan->status_id != 2) {
            return redirect()->route('admin.pengajuan.index')->with('error', 'Offer not yet accepted');
        }

        return DB::transaction(function () use ($penawaran, $request) {

            $validated = $request->validate([
                'dokumen_kontrak' => 'required|file|mimes:pdf|max:2048',
                'pembayaran_term1' => 'required',
                'pembayaran_term2' => 'required',
                'pembayaran_term3' => 'required',
            ]);

            $order = Orders::create([
                'user_id' => $penawaran->pengajuan->user_id,
                'penawaran_id' => $penawaran->id,
                'status_order_id' => OrdersStatus::CONTRACT_SIGNED_EXPORTER,
            ]);

            $kontrak = Kontrak::create([
                'order_id' => $order->id,
                'kontrak_file' => $request->file('dokumen_kontrak')->store('kontrak'),
                'status' => 'signed_by_exporter'
            ]);

            $pembayaran = Pembayaran::create([
                'order_id' => $order->id,
                'pembayaran_term1' => $request->pembayaran_term1,
                'pembayaran_term2' => $request->pembayaran_term2,
                'pembayaran_term3' => $request->pembayaran_term3,
            ]);

            return redirect()->route('admin.pengajuan.index')->with('success', 'Order successfully created');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders)
    {
        $orders = Orders::with('penawaran.pengajuan', 'user.dokumencustomer', 'kontrak', 'pembayaran', 'status_order')->find($orders->id);

        if ($orders->progress) {
            //* images
            $orders->progress->in_production = $this->generateImageUrls($orders->progress, 'in_production');
            $orders->progress->product_finished = $this->generateImageUrls($orders->progress, 'product_finished');
            $orders->progress->product_packing = $this->generateImageUrls($orders->progress, 'product_packing');
            $orders->progress->product_container = $this->generateImageUrls($orders->progress, 'product_container');
        }

        $orderLogs = OrdersLogs::where('order_id', $orders->id)->get();

        // dd($orders);
        return view('transaksi.order.show', compact('orders', 'orderLogs'));
    }

    /**
     * Show the form for customer to upload signed contracts.
     */
    public function uploadKontrakCustomer(Orders $orders)
    {
        if($orders->status_order_id != OrdersStatus::CONTRACT_SIGNED_EXPORTER) {
            return redirect()->route('orders.index')->with('error', 'Contract cannot be uploaded yet');
        }

        $orders = Orders::find($orders->id);

        return view('transaksi.order.update-kontrak', compact('orders'));
    }

    public function updateKontrakCustomer(Orders $orders, Request $request)
    {
        if($orders->status_order_id != OrdersStatus::CONTRACT_SIGNED_EXPORTER) {
            return redirect()->route('orders.index')->with('error', 'Contract cannot be uploaded yet');
        }

        $validated = $request->validate([
            'dokumen_kontrak' => 'required|file|mimes:pdf|max:2048',
        ]);

        $orders = Orders::find($orders->id);

        return DB::transaction(function () use ($orders, $request) {
            $orders->kontrak->update([
                'kontrak_file' => $request->file('dokumen_kontrak')->store('kontrak'),
                'status' => 'signed_by_importer',
            ]);

            $orders->update([
                'status_order_id' => OrdersStatus::CONTRACT_SIGNED_IMPORTER,
            ]);

            return redirect()->route('orders.index')->with('success', 'Contract uploaded successfully');
        });
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Show the form for uploading proof of 1st term payments.
     */
    public function uploadPembayaranTerm1(Orders $orders)
    {
        if($orders->status_order_id != OrdersStatus::CONTRACT_SIGNED_IMPORTER) {
            return redirect()->route('orders.index')->with('error', 'Proof of payment for term 1 cannot be uploaded yet');
        }

        $routeName = 'orders.update-1st-term';
        $title = '1st Term';
        $orders = Orders::with('pembayaran')->find($orders->id);

        return view('transaksi.order.upload-payment', compact('orders', 'routeName', 'title'));
    }
    
    public function updatePembayaranTerm1(Orders $orders, Request $request)
    {
        if($orders->status_order_id != OrdersStatus::CONTRACT_SIGNED_IMPORTER) {
            return redirect()->route('orders.index')->with('error', 'Proof of payment for term 1 cannot be uploaded yet');
        }

        $validated = $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:pdf|max:2048',
        ]);

        $orders = Orders::find($orders->id);

        return DB::transaction(function () use ($orders, $request) {
            $orders->pembayaran->update([
                'dokumen_bukti_term1' => $request->file('bukti_pembayaran')->store('pembayaran'),
            ]);

            $orders->update([
                'status_order_id' => OrdersStatus::FIRST_TERM_PAYMENT_SUBMITTED,
            ]);

            return redirect()->route('orders.index')->with('success', 'Proof of payment of term 1 successfully uploaded');
        });
    }

    /**
     * Show the form for admin to upload invoice of payments.
     */
    public function uploadInvoice1(Orders $orders)
    {
        if($orders->status_order_id != OrdersStatus::FIRST_TERM_PAYMENT_SUBMITTED) {
            return redirect()->route('admin.orders.index')->with('error', 'Invoices cannot be uploaded yet');
        }

        $orders = Orders::with('pembayaran')->find($orders->id);
        $orders->pembayaran->tempUrl = app('getTempUrl')($orders->pembayaran->dokumen_bukti_term1);

        $routeName = 'admin.orders.update-1st-invoice';
        $title = '1st Term';

        return view('transaksi.order.upload-invoice', compact('orders', 'routeName', 'title'));
    }

    public function updateInvoice1(Orders $orders, Request $request)
    {
        if($orders->status_order_id != OrdersStatus::FIRST_TERM_PAYMENT_SUBMITTED) {
            return redirect()->route('admin.orders.index')->with('error', 'Invoices cannot be uploaded yet');
        }

        $validated = $request->validate([
            'invoice' => 'required|file|mimes:pdf|max:2048',
        ]);

        return DB::transaction(function () use ($orders, $request) {
            $orders->update([
                'status_order_id' => OrdersStatus::FIRST_TERM_PAYMENT_RECEIVED,
            ]);

            $orders->pembayaran->update([
                'invoice_term1' => $request->file('invoice')->store('pembayaran'),
            ]);

            return redirect()->route('admin.orders.index')->with('success', 'Invoice uploaded successfully');
        });
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * For admin to update status orders to in production.
     */
    public function updateStatusInProduction(Orders $orders)
    {
        if ($orders->status_order_id != OrdersStatus::FIRST_TERM_PAYMENT_RECEIVED) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }
    
        return DB::transaction(function () use ($orders) {
            $orders->update([
                'status_order_id' => OrdersStatus::PRODUCT_IN_PRODUCTION,
            ]);
    
            Progress::create([
                'order_id' => $orders->id,
            ]);
    
            return redirect()->route('admin.orders.index')->with('success', 'Status successfully changed');
        });
    }

    /**
     * Upload in_production pictures
     */
    public function uploadInProduction(Orders $orders)
    {
        if ($orders->status_order_id != OrdersStatus::PRODUCT_IN_PRODUCTION) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        $orders = Orders::with('progress')->find($orders->id);
        $routeName = 'admin.orders.store-in-production';
        $title = 'In Production';

        return view('transaksi.order.upload-photos', compact('orders', 'routeName', 'title'));
    }
    public function updateInProduction(Orders $orders, Request $request)
    {
        $result = $this->uploadPhotos($orders, $request, 'in_production');

        if (isset($result->success) && !$result->success) {
            return redirect()->back()->with('error', $result->message);
        }

        return redirect()->route('admin.orders.index')->with('success', 'Production photos uploaded successfully');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function updateStatusProductFinished(Orders $orders)
    {
        if ($orders->status_order_id != OrdersStatus::PRODUCT_IN_PRODUCTION) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        return DB::transaction(function () use ($orders) {
            $orders->update([
                'status_order_id' => OrdersStatus::PRODUCTION_COMPLETED,
            ]);

            return redirect()->route('admin.orders.index')->with('success', 'Status successfully changed');
        });
    }

    public function uploadProductFinished(Orders $orders)
    {
        if ($orders->status_order_id != OrdersStatus::PRODUCTION_COMPLETED) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        $orders = Orders::with('progress')->find($orders->id);
        $routeName = 'admin.orders.store-finished';
        $title = 'Finished Product';

        return view('transaksi.order.upload-photos', compact('orders', 'routeName', 'title'));
    }

    public function updateProductFinished(Orders $orders, Request $request)
    {
        $result = $this->uploadPhotos($orders, $request, 'product_finished');
        
        if (isset($result->success) && !$result->success) {
            return redirect()->back()->with('error', $result->message);
        }
        
        return redirect()->route('admin.orders.index')->with('success', 'Finished product successfully uploaded');
    }

    public function uploadTestLab(Orders $orders)
    {
        if ($orders->status_order_id != OrdersStatus::PRODUCTION_COMPLETED) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        if ($orders->progress->lab_test_document) {
            return redirect()->route('admin.orders.index')->with('error', 'Laboratory test document has been uploaded');
        }

        $orders = Orders::with('progress')->find($orders->id);

        return view('transaksi.order.update-test-lab', compact('orders'));
    }

    public function updateTestLab(Orders $orders, Request $request)
    {
        if ($orders->status_order_id != OrdersStatus::PRODUCTION_COMPLETED) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        if ($orders->progress->lab_test_document) {
            return redirect()->route('admin.orders.index')->with('error', 'Laboratory test document has been uploaded');
        }

        $validated = $request->validate([
            'lab_test_document' => 'required|file|mimes:pdf|max:2048',
        ]);
        DB::transaction(function () use ($orders, $request) {
            $orders->progress->update([
                'lab_test_document' => $request->file('lab_test_document')->store('lab_test'),
            ]);

            $orders->update([
                'status_order_id' => OrdersStatus::TEST_LAB_SENT,
            ]);
        });

        return redirect()->route('admin.orders.index')->with('success', 'Laboratory test document uploaded successfully');
    }
    
    public function uploadPembayaranTerm2(Orders $orders)
    {
        if ($orders->status_order_id != OrdersStatus::TEST_LAB_SENT || !$orders->progress->lab_test_document) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        $routeName = 'orders.update-2nd-term';
        $title = '2nd Term';
        $orders = Orders::with('progress')->find($orders->id);

        return view('transaksi.order.upload-payment', compact('orders', 'routeName', 'title'));
    }
    public function updatePembayaranTerm2(Orders $orders, Request $request)
    {
        if ($orders->status_order_id != OrdersStatus::TEST_LAB_SENT || !$orders->progress->lab_test_document) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        $validated = $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:pdf|max:2048',
        ]);

        $orders->pembayaran->update([
            'dokumen_bukti_term2' => $request->file('bukti_pembayaran')->store('pembayaran'),
        ]);

        $orders->update([
            'status_order_id' => OrdersStatus::SECOND_TERM_PAYMENT_SUBMITTED,
        ]);

        return redirect()->route('orders.index')->with('success', 'Proof of payment of term 2 successfully uploaded');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function uploadInvoice2(Orders $orders)
    {
        if($orders->status_order_id != OrdersStatus::SECOND_TERM_PAYMENT_SUBMITTED) {
            return redirect()->route('admin.orders.index')->with('error', 'Invoices cannot be uploaded yet');
        }

        $orders = Orders::with('pembayaran')->find($orders->id);
        $orders->pembayaran->tempUrl = app('getTempUrl')($orders->pembayaran->dokumen_bukti_term2);
        $routeName = 'admin.orders.update-2nd-invoice';
        $title = '2nd Term';

        return view('transaksi.order.upload-invoice', compact('orders', 'routeName', 'title'));
    }

    public function updateInvoice2(Orders $orders, Request $request)
    {
        if($orders->status_order_id != OrdersStatus::SECOND_TERM_PAYMENT_SUBMITTED) {
            return redirect()->route('admin.orders.index')->with('error', 'Invoices cannot be uploaded yet');
        }

        $validated = $request->validate([
            'invoice' => 'required|file|mimes:pdf|max:2048',
        ]);

        return DB::transaction(function () use ($orders, $request) {
            $orders->update([
                'status_order_id' => OrdersStatus::SECOND_TERM_PAYMENT_RECEIVED,
            ]);

            $orders->pembayaran->update([
                'invoice_term2' => $request->file('invoice')->store('pembayaran'),
            ]);

            return redirect()->route('admin.orders.index')->with('success', 'Invoice uploaded successfully');
        });
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
        
    public function uploadProductPacking(Orders $orders)
    {
        if ($orders->status_order_id != OrdersStatus::SECOND_TERM_PAYMENT_RECEIVED) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        $orders = Orders::with('progress')->find($orders->id);
        $routeName = 'admin.orders.store-packing';
        $title = 'Product Packing';

        return view('transaksi.order.upload-photos', compact('orders', 'routeName', 'title'));
    }

    public function updateProductPacking(Orders $orders, Request $request)
    {
        $result = $this->uploadPhotos($orders, $request, 'product_packing');

        if (isset($result->success) && !$result->success) {
            return redirect()->back()->with('error', $result->message);
        }

        return redirect()->route('admin.orders.index')->with('success', 'Packing photos uploaded successfully');
    }

    public function uploadDokumenShipping(Orders $orders)
    {
        if ($orders->status_order_id != OrdersStatus::SECOND_TERM_PAYMENT_RECEIVED) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        if ($orders->progress->shipping_document) {
            return redirect()->route('admin.orders.index')->with('error', 'Shipping documents have been uploaded');
        }

        $orders = Orders::with('progress')->find($orders->id);

        return view('transaksi.order.update-shipping', compact('orders'));
    }

    public function updateDokumenShipping(Orders $orders, Request $request)
    {
        if ($orders->status_order_id != OrdersStatus::SECOND_TERM_PAYMENT_RECEIVED) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        if ($orders->progress->shipping_document) {
            return redirect()->route('admin.orders.index')->with('error', 'Shipping documents have been uploaded');
        }

        $validated = $request->validate([
            'shipping_document' => 'required|file|mimes:pdf|max:2048',
        ]);

        DB::transaction(function () use ($orders, $request) {
            $orders->progress->update([
                'shipping_document' => $request->file('shipping_document')->store('shipping'),
            ]);

            $orders->update([
                'status_order_id' => OrdersStatus::FREIGHT_DOCUMENTS_SENT,
            ]);
        });
         
        return redirect()->route('admin.orders.index')->with('success', 'Shipping document uploaded successfully');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function uploadPembayaranTerm3(Orders $orders)
    {
        if ($orders->status_order_id != OrdersStatus::FREIGHT_DOCUMENTS_SENT) {
            return redirect()->route('admin.orders.index')->with('error', 'Proof of payment for term 3 cannot be uploaded yet');
        }

        $routeName = 'orders.update-3rd-term';
        $title = '3rd Term';
        $orders = Orders::with('pembayaran')->find($orders->id);

        return view('transaksi.order.upload-payment', compact('orders', 'routeName', 'title'));
    }

    public function updatePembayaranTerm3(Orders $orders, Request $request)
    {
        if ($orders->status_order_id != OrdersStatus::FREIGHT_DOCUMENTS_SENT) {
            return redirect()->route('admin.orders.index')->with('error', 'Proof of payment for term 3 cannot be uploaded yet');
        }

        $validated = $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:pdf|max:2048',
        ]);

        $orders = Orders::find($orders->id);

        return DB::transaction(function () use ($orders, $request) {
            $orders->pembayaran->update([
                'dokumen_bukti_term3' => $request->file('bukti_pembayaran')->store('pembayaran'),
            ]);

            $orders->update([
                'status_order_id' => OrdersStatus::THIRD_TERM_PAYMENT_SUBMITTED,
            ]);

            return redirect()->route('orders.index')->with('success', 'Proof of payment of term 3 successfully uploaded');
        });
    }

    public function uploadInvoice3(Orders $orders)
    {
        if($orders->status_order_id != OrdersStatus::THIRD_TERM_PAYMENT_SUBMITTED) {
            return redirect()->route('admin.orders.index')->with('error', 'Invoices cannot be uploaded yet');
        }

        $orders = Orders::with('pembayaran')->find($orders->id);
        $orders->pembayaran->tempUrl = app('getTempUrl')($orders->pembayaran->dokumen_bukti_term3);
        $routeName = 'admin.orders.update-3rd-invoice';
        $title = '3rd Term';

        return view('transaksi.order.upload-invoice', compact('orders', 'routeName', 'title'));
    }

    public function updateInvoice3(Orders $orders, Request $request)
    {
        if($orders->status_order_id != OrdersStatus::THIRD_TERM_PAYMENT_SUBMITTED) {
            return redirect()->route('admin.orders.index')->with('error', 'Invoices cannot be uploaded yet');
        }

        $validated = $request->validate([
            'invoice' => 'required|file|mimes:pdf|max:2048',
        ]);

        return DB::transaction(function () use ($orders, $request) {
            $orders->update([
                'status_order_id' => OrdersStatus::THIRD_TERM_PAYMENT_RECEIVED,
            ]);

            $orders->pembayaran->update([
                'invoice_term3' => $request->file('invoice')->store('pembayaran'),
            ]);

            return redirect()->route('admin.orders.index')->with('success', 'Invoice uploaded successfully');
        });
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function uploadShippingContainer(Orders $orders)
    {
        if ($orders->status_order_id != OrdersStatus::THIRD_TERM_PAYMENT_RECEIVED) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        $orders = Orders::with('progress')->find($orders->id);
        $routeName = 'admin.orders.store-container';
        $title = 'Shipping Container';

        return view('transaksi.order.upload-photos', compact('orders', 'routeName', 'title'));
    }
    public function updateShippingContainer(Orders $orders, Request $request)
    {
        if ($orders->status_order_id != OrdersStatus::THIRD_TERM_PAYMENT_RECEIVED) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        $result = $this->uploadPhotos($orders, $request, 'product_container');

        if (isset($result->success) && !$result->success) {
            return redirect()->back()->with('error', $result->message);
        }
         
        return redirect()->route('admin.orders.index')->with('success', 'Container photos uploaded successfully');
    }

    public function uploadBOL(Orders $orders)
    {
        if ($orders->status_order_id != OrdersStatus::THIRD_TERM_PAYMENT_RECEIVED) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        if ($orders->progress->bill_of_lading) {
            return redirect()->route('admin.orders.index')->with('error', 'Bill of lading document has been uploaded');
        }

        $orders = Orders::with('progress')->find($orders->id);

        return view('transaksi.order.update-bol', compact('orders'));
    }

    public function updateBOL(Orders $orders, Request $request)
    {
        if ($orders->status_order_id != OrdersStatus::THIRD_TERM_PAYMENT_RECEIVED) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        if ($orders->progress->bill_of_lading) {
            return redirect()->route('admin.orders.index')->with('error', 'Bill of lading document has been uploaded');
        }

        $validated = $request->validate([
            'bill_of_lading' => 'required|file|mimes:pdf|max:2048',
        ]);

        DB::transaction(function () use ($orders, $request) {
            $orders->progress->update([
                'bill_of_lading' => $request->file('bill_of_lading')->store('bill_of_lading'),
            ]);

            $orders->update([
                'status_order_id' => OrdersStatus::BILL_OF_LADING_SENT,
            ]);
        });
         
        return redirect()->route('admin.orders.index')->with('success', 'Bill of lading document uploaded successfully');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function updateStatusDelivered(Orders $orders)
    {
        if ($orders->status_order_id != OrdersStatus::BILL_OF_LADING_SENT) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        return DB::transaction(function () use ($orders) {
            $orders->update([
                'status_order_id' => OrdersStatus::PRODUCT_SAFELY_ARRIVED,
            ]);

            return redirect()->route('admin.orders.index')->with('success', 'Status successfully changed');
        });
    }

    public function updateStatusComplete(Orders $orders)
    {
        if ($orders->status_order_id != OrdersStatus::PRODUCT_SAFELY_ARRIVED) {
            return redirect()->route('admin.orders.index')->with('error', 'Status cannot be changed yet');
        }

        return DB::transaction(function () use ($orders) {
            $orders->update([
                'status_order_id' => OrdersStatus::TRANSACTION_COMPLETED,
            ]);

            return redirect()->route('orders.index')->with('success', 'Status successfully changed');
        });
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    private function uploadPhotos(Orders $orders, Request $request, $column)
    {
        // Check the status before proceeding
        $statusCheck = $this->checkStatus($orders, $column);

        if ($statusCheck) {
            return $statusCheck;
        }

        // Validate the incoming files
        $validated = $request->validate([
            'foto' => 'required|array|min:1',
            'foto.*' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        return DB::transaction(function () use ($orders, $request, $column) {
            $progress = $orders->progress;

            // Get the current photos or set to an empty array if null
            $currentPhotos = json_decode($progress->$column, true) ?? [];

            foreach ($request->file('foto') as $uploadedFile) {
                // Add the new photo to the array
                $newPhotoPath = $uploadedFile->store('progress');
                $currentPhotos[] = $newPhotoPath;
            }

            // Update the specified column with the updated array
            $progress->update([
                $column => json_encode($currentPhotos),
            ]);

            return [
                'success' => true,
                'message' => 'Photos uploaded successfully.',
            ];
        });
    }

    private function checkStatus(Orders $orders, $column)
    {
        $statuses = [
            'in_production' => OrdersStatus::PRODUCT_IN_PRODUCTION,
            'product_finished' => OrdersStatus::PRODUCTION_COMPLETED,
            'product_packing' => OrdersStatus::SECOND_TERM_PAYMENT_RECEIVED,
            'product_container' => OrdersStatus::THIRD_TERM_PAYMENT_RECEIVED,
        ];

        if ($orders->status_order_id != $statuses[$column]) {
            return redirect()->route('orders.index')->with('error', 'Status does not match');
        }

        return null;
    }
    private function generateImageUrls($progress, $columnName)
    {
        // Check if progress and the specified column are not null
        if ($progress && $progress->{$columnName}) {
            $decodedImages = json_decode($progress->{$columnName}, true);

            // Transform each image path to a temporary URL
            return array_map(function ($value) {
                return app('getTempUrl')($value);
            }, $decodedImages);
        } else {
            // Handle case where progress or the specified column is null
            return [];
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
