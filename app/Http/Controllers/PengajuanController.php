<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Http\Controllers\Controller;
use App\Models\StatusPengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexCustomer()
    {
        /**
         * Get all pengajuan data for the authenticated user with their status pengajuan.
         */
        $user = auth()->user()->id;
        $pengajuan = Pengajuan::where('user_id', $user)->with('statusPengajuan')->get();
        /**
         * Transform the $pengajuan collection by adding a temporary URL for each item's document.
         */
        $pengajuan->transform(function ($item) {
            $path = $item->dokumen;
            $tempUrl = $item->getTempUrl($path);
            $item->tempUrl = $tempUrl;
            return $item;
        });
        return view('transaksi.pengajuan.customer.index', compact('pengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        return view('transaksi.pengajuan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required',
            'jumlah' => 'required',
            'dokumen' => 'required|file|mimes:pdf|max:2048',
        ]);

        $path = Storage::putFile('dokumen', $request->file('dokumen'));

        $pengajuan = Pengajuan::create([
            'user_id' => auth()->id(),
            'status_id' => '1', // (Menunggu)
            'nama_produk' => $validated['nama_produk'],
            'jumlah' => $validated['jumlah'],
            'dokumen' => $validated['dokumen']->store('dokumen'),
        ]);

        return redirect()->route('pengajuan.index')->with('success','Pengajuan berhasil dibuat');
    }

    /**************************************************************************
     * Method for admin
     */
    public function indexAdmin()
    {
        /**
         * Get all pengajuan data with their status pengajuan.
         */
        $pengajuan = Pengajuan::with('statusPengajuan')->get();
        /**
         * Transform the $pengajuan collection by adding a temporary URL for each item's document.
         */
        $pengajuan->transform(function ($item) {
            $path = $item->dokumen;
            $tempUrl = $item->getTempUrl($path);
            $item->tempUrl = $tempUrl;
            return $item;
        });
        return view('transaksi.pengajuan.admin.index', compact('pengajuan'));
    }

    public function approve(Request $request, Pengajuan $pengajuan)
    {
        $pengajuan->update(['status_id' => 2]); // change status_id to Disetujui
        return redirect()->route('admin.pengajuan.index')->with('success','Pengajuan berhasil disetujui');
    }

    public function reject(Request $request, Pengajuan $pengajuan)
    {
        $pengajuan->update(['status_id' => 3]); // change status_id to Ditolak
        return redirect()->route('admin.pengajuan.index')->with('success','Pengajuan berhasil ditolak');
    }
}
