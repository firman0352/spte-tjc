<?php

namespace App\Http\Controllers;

use App\Models\Verifikasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DokumenCustomer;
use App\Models\Inspektur;
use App\Models\StatusDokumen;
use App\Models\User;
use App\Models\StatusLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;

class VerifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statusIds = $request->query('status_ids', []); // Default to an empty array if no query parameter is provided

        if(empty($statusIds)) {
            $verifikasi = Verifikasi::with(['dokumenCustomer', 'inspektur', 'inspektur2', 'statusDokumen'])->get();
        }
        else {
            $verifikasi = Verifikasi::whereIn('status_id',$statusIds)->with(['dokumenCustomer', 'inspektur', 'inspektur2', 'statusDokumen'])->get();
        }

        return view('verifikasi.index', compact('verifikasi'));
    }
    public function history()
    {
        $verifikasi = DokumenCustomer::where('status_id','3')->with(['user:id,name,email,phone', 'status:id,status', 'verifikasi'])->get();
        return view('verifikasi.history', compact('verifikasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($dokumen)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Verifikasi $verifikasi)
    {
        $verifikasi->load(['dokumenCustomer', 'inspektur', 'statusDokumen']);

        return view('verifikasi.show', compact('verifikasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Verifikasi $verifikasi)
    {
        return view('verifikasi.edit', compact('verifikasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Verifikasi $verifikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Verifikasi $verifikasi)
    {
        $verifikasi->delete();
        DokumenCustomer::where('id', $verifikasi->dokumen_customer_id)->update([
            'status_id' => '1',
        ]);

        return redirect()->route('verifikasi.index');
    }

    ////////////////////////////////////////////////
    public function menungguVerifikasi()
    {
        $dokumen = DokumenCustomer::with(['user:id,name,email', 'status:id,status'])->where('status_id', StatusDokumen::MENUNGGU)->get();

        return view('verifikasi.menunggu', compact('dokumen'));
    }

    // Admin
    public function createVerifikasi($dokumen)
    {
        $dokumenCustomers = DokumenCustomer::where('id', $dokumen)->get();
        $inspektur1 = Inspektur::where('jabatan_id', '1')->get();
        $inspektur2 = Inspektur::where('jabatan_id', '2')->get();
        $statusDokumens = StatusDokumen::where('id', '6')->get();

        return view('verifikasi.create', compact('dokumenCustomers', 'inspektur1', 'inspektur2' , 'statusDokumens'));
    }

    public function verifikasiAdmin(Request $request)
    {
        $validated= $request->validate([
            'dokumen_customer_id' => 'unique:verifikasis|exists:dokumen_customers,id',
        ]);
        Verifikasi::create(([
            'dokumen_customer_id' => $request->input('dokumen_customer_id'),
            'inspektur_id' => $request->input('inspektur_id'),
            'inspektur2_id' => $request->input('inspektur2_id'),
            'status_id' => '6',
            'tanggal_mulai' => Carbon::now(),
        ]));
        StatusLog::create([
            'dokumen_customer_id' => $request->input('dokumen_customer_id'),
            'status_id' => '6',
            'user_id' => auth()->user()->id,
        ]);

        DokumenCustomer::where('id', $request->input('dokumen_customer_id'))->update([
            'status_id' => '6',
        ]);

        return redirect()->route('admin.verifikasi.menunggu');
    }

    public function tolakMenunggu($dokumen)
    {
        DokumenCustomer::where('id', $dokumen)->update([
            'status_id' => '4',
        ]);

        StatusLog::create([
            'dokumen_customer_id' => $dokumen,
            'status_id' => '4',
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('admin.verifikasi.menunggu');
    }
    // End Admin

    ////////////////////////////////////////////////
    // Inspektur
    public function indexInspektur()
    {
        $inspektur_id = auth()->user()->inspektur->id;
        $jabatan_id = auth()->user()->inspektur->jabatan_id;

        $query = Verifikasi::with(['dokumenCustomer', 'inspektur', 'statusDokumen']);

        if ($jabatan_id == '1') {
            $query->where('inspektur_id', $inspektur_id)->where('status_id', '6');
        } elseif ($jabatan_id == '2') {
            $query->where('inspektur2_id', $inspektur_id)->where('status_id', '7');
        }

        $verifikasi = $query->get();

        return view('verifikasi.inspektur.index', compact('verifikasi'));
    }

    public function showInspektur(Verifikasi $verifikasi)
    {
        $verifikasi->load(['dokumenCustomer', 'inspektur','inspektur2', 'statusDokumen']);
        
        return view('verifikasi.inspektur.show', compact('verifikasi'));
    }

    public function approveInspektur(Verifikasi $verifikasi)
    {
        $user = Auth::user();
        $inspekturId = $user->inspektur->id;
        $statusId = $verifikasi->status_id;
    
        if ($statusId == 6) {
            if ($inspekturId == $verifikasi->inspektur_id) {
                $verifikasi->update([
                    'status_id' => 7,
                ]);
    
                $dokumenCustomer = $verifikasi->dokumenCustomer;
                $dokumenCustomer->status_id = 7;
                $dokumenCustomer->save();
                StatusLog::create([
                    'dokumen_customer_id' => $verifikasi->dokumen_customer_id,
                    'status_id' => 7,
                    'user_id' => auth()->user()->id,
                ]);
            } else {
                abort(403);
            }
        } elseif ($statusId == 7) {
            if ($inspekturId == $verifikasi->inspektur2_id) {
                $verifikasi->update([
                    'status_id' => 3,
                    'tanggal_selesai' => Carbon::now(),
                ]);
    
                $dokumenCustomer = $verifikasi->dokumenCustomer;
                $dokumenCustomer->status_id = 3;
                $dokumenCustomer->save();
                StatusLog::create([
                    'dokumen_customer_id' => $verifikasi->dokumen_customer_id,
                    'status_id' => 3,
                    'user_id' => auth()->user()->id,
                ]);
            } else {
                abort(403);
            }
        }

        return redirect()->route('inspektur.verifikasi.index');
    }

    public function rejectInspektur(Request $request, Verifikasi $verifikasi)
    {
        if (!auth()->user()->inspektur->id == $verifikasi->inspektur_id || !auth()->user()->inspektur->id == $verifikasi->inspektur2_id) {
            abort(403);
        }

        $validated = $request->validate([
            'comment' => 'string|nullable',
        ]);

        $jabatan = auth()->user()->inspektur->jabatan->jabatan;

        $rejection_comment = 'Revised by ' . $jabatan . ' at ' . Carbon::now()->format('d-m-Y') . ' : ' . $request->input('comment');

        $verifikasi->update([
            'status_id' => 4,
            'comment' => $rejection_comment,
            'rejecting_inspektur' => auth()->user()->inspektur->jabatan_id,
        ]);

        $verifikasi->dokumenCustomer->update([
            'status_id' => 4,
        ]);

        StatusLog::create([
            'dokumen_customer_id' => $verifikasi->dokumen_customer_id,
            'status_id' => 4,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('inspektur.verifikasi.index');
    }
    // End Inspektur


    // Inspektur 1
    public function showInspektur1(Verifikasi $verifikasi)
    {
        $verifikasi->load(['dokumenCustomer', 'inspektur', 'statusDokumen']);
        
        return view('verifikasi.inspektur1.show', compact('verifikasi'));
    }

    public function approveInspektur1(Verifikasi $verifikasi)
    {
        $verifikasi->update([
            'status_id' => '7',
        ]);

        return redirect()->route('inspektur1.verifikasi.index');
    }
    // End Inspektur 1

    ////////////////////////////////////////////////

    // Inspektur 2
    public function indexInspektur2()
    {
        $verifikasi = Verifikasi::with(['dokumenCustomer', 'inspektur', 'statusDokumen'])->where('inspektur2_id', auth()->user()->id)->get();

        return view('verifikasi.inspektur2.index', compact('verifikasi'));
    }

    public function showInspektur2(Verifikasi $verifikasi)
    {
        $verifikasi->load(['dokumenCustomer', 'inspektur', 'statusDokumen']);
        
        return view('verifikasi.inspektur2.show', compact('verifikasi'));
    }

    public function approveInspektur2(Verifikasi $verifikasi)
    {
        $verifikasi->update([
            'status_id' => '8',
            'tanggal_selesai' => Carbon::now(),
        ]);

        return redirect()->route('inspektur2.verifikasi.index');
    }
    // End Inspektur 2
}
