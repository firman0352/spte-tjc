<?php

namespace App\Http\Controllers;

use App\Models\PenawaranHarga;
use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenawaranHargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create($pengajuan)
    {
        /**
         * Check if there is already penawaran for this pengajuan.
         */
        $penawaran = PenawaranHarga::where('pengajuan_id', $pengajuan)->first();
        if ($penawaran) {
            return redirect()->route('admin.pengajuan.index')->with('error', 'Price quotation already made');
        } 
            
        $pengajuan = Pengajuan::where('id', $pengajuan)->first();

        return view('transaksi.penawaran-harga.create', compact('pengajuan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Pengajuan $pengajuan, Request $request)
    {
        /**
         * Check if there is already penawaran for this pengajuan.
         */
        $penawaran = PenawaranHarga::where('pengajuan_id', $pengajuan)->first();
        if ($penawaran) {
            return redirect()->route('admin.pengajuan.index')->with('error', 'Price quotation already made');
        }
        /**
         * Validate the request.
         */
        $validated = $request->validate([
            'harga' => 'required',
            'dokumen' => 'required|file|mimes:pdf|max:2048',
        ]);
        /**
         * Store the file in s3 storage.
         */
        $path = Storage::putFile('dokumen', $request->file('dokumen'));
        /**
         * Create a new penawaran harga.
         */
        PenawaranHarga::create([
            'pengajuan_id' => $pengajuan->id,
            'harga' => $validated['harga'],
            'dokumen' => $path,
        ]);

        return redirect()->route('admin.pengajuan.index')->with('success', 'Price quotation created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(PenawaranHarga $penawaran)
    {
        if($penawaran->dokumen != null){
            $tempUrl = $penawaran->getTempUrl($penawaran->dokumen);
            $penawaran['tempUrl'] = $tempUrl;
        }
        
        return view('transaksi.penawaran-harga.show', compact('penawaran'));
    }

    /**
     * Show the form for submitting final penawaran document.
     */
    public function finalDokumen(PenawaranHarga $penawaran)
    {
        if($penawaran->status_id == 2 && $penawaran->dokumen == null){
            return view('transaksi.penawaran-harga.final-dokumen', compact('penawaran'));
        } else {
            abort(403, 'Price quotes have been responded to');
        }
    }

    /**
     * Store final penawaran document.
     */
    public function storeFinalDokumen(Request $request, PenawaranHarga $penawaran)
    {
        if($penawaran->status_id == 2 && $penawaran->dokumen == null){
            $validated = $request->validate([
                'dokumen' => 'required|file|mimes:pdf|max:2048',
            ]);
    
            $path = Storage::putFile('dokumen', $request->file('dokumen'));
    
            $penawaran->dokumen = $path;
            $penawaran->save();
    
            return redirect()->route('admin.pengajuan.index')->with('success', 'Price quote successfully approved');
        } else {
            abort(403, 'Price quotes have been responded to');
        }
    }

    /**
     * Update new harga for penawaran by admin.
     */
    public function edit(PenawaranHarga $penawaran)
    {
        if($penawaran->status_id != 4) {
            abort(403, 'Price quotes have been responded to');
        }

        return view('transaksi.penawaran-harga.edit', compact('penawaran'));
    }
    public function update(Request $request, PenawaranHarga $penawaran)
    {
        if($penawaran->status_id != 4) {
            abort(403, 'Price quotes have been responded to');
        }

        $validated = $request->validate([
            'harga' => 'required',
        ]);

        $penawaran->harga = $validated['harga'];
        $penawaran->status_id = 5;
        $penawaran->save();

        return redirect()->route('admin.pengajuan.index')->with('success', 'Price quote successfully modified');
    }


    /**
     * Approve penawaran by customer
     */
    public function approve(PenawaranHarga $penawaran)
    {
        if($penawaran->status_id != 1 && $penawaran->status_id != 5) {
            return redirect()->route('pengajuan.index')->with('error', 'Price quotation has been responded to');
        }
        $penawaran->status_id = 2;
        $penawaran->save();
        $penawaran->keterangan = null;

        return redirect()->route('pengajuan.index')->with('success', 'Price quote successfully approved');
    }

    /**
     * Reject penawaran by customer
     */
    public function reject(PenawaranHarga $penawaran, Request $request)
    {
        if($penawaran->status_id != 1 && $penawaran->status_id != 5) {
            abort(403, 'Price quotation has been responded to');
        }
        
        $penawaran->status_id = 3;
        $penawaran->save();

        return redirect()->route('pengajuan.index')->with('success', 'Successfully rejected price quote');
    }

    public function negotiate(PenawaranHarga $penawaran, Request $request)
    {
        if($penawaran->status_id != 1 && $penawaran->status_id != 5) {
            abort(403, 'Price quotation has been responded to');
        }

        $validated = $request->validate([
            'keterangan' => 'required',
        ]);

        $penawaran->keterangan = $validated['keterangan'];
        $penawaran->status_id = 4;
        $penawaran->save();

        return redirect()->route('pengajuan.index')->with('success', 'Price quote successfully negotiated');
    }

    public function rejectAdmin(PenawaranHarga $penawaran, Request $request)
    {
        if($penawaran->status_id != 4) {
            abort(403, 'Price quotes have been responded to');
        }

        $penawaran->status_id = 3;
        $penawaran->save();

        return redirect()->route('admin.pengajuan.index')->with('success', 'Successfully rejected price quote');
    }
}
