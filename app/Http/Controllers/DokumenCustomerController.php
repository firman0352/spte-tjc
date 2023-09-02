<?php

namespace App\Http\Controllers;

use App\Models\DokumenCustomer;
use App\Models\StatusDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->DokumenCustomer) {
            return view ('dokumen.index', [
                'dokumen' => null,
                'tempUrl' => null,
            ]);
        }
        $dokumen = auth()->user()->DokumenCustomer->with('status:id,status')->first();

        $path = $dokumen->dokumen;
        $tempUrl = Storage::temporaryUrl($path, now()->addMinutes(5));

        return view('dokumen.index', compact('dokumen', 'tempUrl'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->DokumenCustomer) {
            return redirect()->route('dokumen.index')->with('error', 'Anda sudah mengupload dokumen');
        }

        return view('dokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->DokumenCustomer) {
            return redirect()->route('dokumen.index')->with('error', 'Anda sudah mengupload dokumen');
        }

        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf|max:2048',
            'nama_pt' => 'required',
            'alamat_pt' => 'required',
            'no_telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:17',
        ]);

        $path = Storage::putFile('dokumen', $request->file('file'));

        DokumenCustomer::create([
            'dokumen' => $path,
            'user_id' => auth()->user()->id,
            'status_id' => StatusDokumen::MENUNGGU,
            'nama_pt' => $request->nama_pt,
            'alamat_pt' => $request->alamat_pt,
            'no_telp' => $request->no_telp,            
        ]);

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DokumenCustomer $dokumen)
    {
        if ($dokumen->status_id != StatusDokumen::MENUNGGU && $dokumen->status_id != StatusDokumen::PERBAIKAN) {
            return redirect()->route('dokumen.index')->with('error', 'Anda tidak dapat mengubah dokumen dengan status saat ini.');
        }

        return view('dokumen.edit', compact('dokumen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DokumenCustomer $dokumen)
    {
        // Check if the current status is 1 or 4
        if ($dokumen->status_id != StatusDokumen::MENUNGGU && $dokumen->status_id != StatusDokumen::PERBAIKAN) {
            return redirect()->route('dokumen.index')->with('error', 'Anda tidak dapat mengubah dokumen dengan status saat ini.');
        }

        // Validate the request data
        $validated = $request->validate([
            'file' => 'sometimes|file|mimes:pdf|max:2048', // Allow file update, but not required
            'nama_pt' => 'required',
            'alamat_pt' => 'required',
            'no_telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:17',
        ]);

        // Update the document fields if they are provided in the request
        if ($request->hasFile('file')) {
            // Handle file upload and update
            Storage::delete($dokumen->dokumen); // Delete the old file
            $path = Storage::putFile('dokumen', $request->file('file'));
            $dokumen->update(['dokumen' => $path]);
        }

        // Update other fields
        $dokumen->update([
            'nama_pt' => $request->nama_pt,
            'alamat_pt' => $request->alamat_pt,
            'no_telp' => $request->no_telp,
            'status_id' => StatusDokumen::MENUNGGU,
        ]);

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DokumenCustomer $dokumen)
    {
        if ($dokumen->status_id != StatusDokumen::MENUNGGU && $dokumen->status_id != StatusDokumen::PERBAIKAN) {
            return redirect()->route('dokumen.index')->with('error', 'Anda tidak dapat menghapus dokumen dengan status saat ini.');
        }

        $path = $dokumen->dokumen;

        Storage::delete($path);
        $dokumen->delete();
        
        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil dihapus');
    }
}
