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
            return redirect()->route('admin.pengajuan.index')->with('error', 'Penawaran harga sudah dibuat');
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
            return redirect()->route('admin.pengajuan.index')->with('error', 'Penawaran harga sudah dibuat');
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
        $path = Storage::putFile('penawaran', $request->file('dokumen'));
        /**
         * Create a new penawaran harga.
         */
        PenawaranHarga::create([
            'pengajuan_id' => $pengajuan->id,
            'harga' => $validated['harga'],
            'dokumen' => $path,
        ]);

        return redirect()->route('admin.pengajuan.index')->with('success', 'Penawaran harga berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(PenawaranHarga $penawaran)
    {
        $tempUrl = $penawaran->getTempUrl($penawaran->dokumen);
        $penawaran['tempUrl'] = $tempUrl;
        
        return view('transaksi.penawaran-harga.show', compact('penawaran'));
    }

    /**
     * Update new harga for penawaran by admin.
     */
    public function edit(PenawaranHarga $penawaran)
    {
        if($penawaran->status_id != 4) {
            abort(403, 'Penawaran harga sudah ditanggapi');
        }

        return view('transaksi.penawaran-harga.edit', compact('penawaran'));
    }
    public function update(Request $request, PenawaranHarga $penawaran)
    {
        if($penawaran->status_id != 4) {
            abort(403, 'Penawaran harga sudah ditanggapi');
        }

        $validated = $request->validate([
            'harga' => 'required',
            'dokumen' => 'required|file|mimes:pdf|max:2048',
        ]);

        $path = Storage::putFile('penawaran', $request->file('dokumen'));

        $penawaran->dokumen = $path;
        $penawaran->harga = $validated['harga'];
        $penawaran->status_id = 5;
        $penawaran->save();

        return redirect()->route('admin.pengajuan.index')->with('success', 'Penawaran harga berhasil diubah');
    }


    /**
     * Approve penawaran by customer
     */
    public function approve(PenawaranHarga $penawaran)
    {
        if($penawaran->status_id != 1 && $penawaran->status_id != 5) {
            return redirect()->route('pengajuan.index')->with('error', 'Penawaran harga sudah ditanggapi');
        }
        $penawaran->status_id = 2;
        $penawaran->save();
        $penawaran->keterangan = null;

        return redirect()->route('pengajuan.index')->with('success', 'Penawaran harga berhasil disetujui');
    }

    /**
     * Reject penawaran by customer
     */
    public function reject(PenawaranHarga $penawaran, Request $request)
    {
        if($penawaran->status_id != 1 && $penawaran->status_id != 5) {
            abort(403, 'Penawaran harga sudah ditanggapi');
        }
        if($request->keterangan == '') {
            $penawaran->status_id = 3;
        } else {
            $penawaran->status_id = 4;
            $penawaran->keterangan = $request->keterangan;
        }

        $penawaran->save();

        return redirect()->route('pengajuan.index')->with('success', 'Penawaran harga berhasil ditolak');
    }

    public function rejectAdmin(PenawaranHarga $penawaran, Request $request)
    {
        if($penawaran->status_id != 4) {
            abort(403, 'Penawaran harga sudah ditanggapi');
        }

        $penawaran->status_id = 3;
        $penawaran->save();

        return redirect()->route('admin.pengajuan.index')->with('success', 'Penawaran harga berhasil ditolak');
    }
}
