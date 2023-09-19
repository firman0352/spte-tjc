<?php

namespace App\Http\Controllers;

use App\Models\Verifikasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DokumenCustomer;
use App\Models\Inspektur;
use App\Models\StatusDokumen;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;

class VerifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $verifikasi = Verifikasi::with(['dokumenCustomer', 'inspektur', 'statusDokumen'])->get();

        return view('verifikasi.index', compact('verifikasi'));
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

    public function createVerifikasi($dokumen)
    {
        $dokumenCustomers = DokumenCustomer::where('id', $dokumen)->get();
        $inspekturs = Inspektur::where('jabatan_id', '1')->get();
        $statusDokumens = StatusDokumen::where('id', '6')->get();

        return view('verifikasi.create', compact('dokumenCustomers', 'inspekturs', 'statusDokumens'));
    }

    public function verifikasiAdmin(Request $request)
    {
        $validated= $request->validate([
            'dokumen_customer_id' => 'unique:verifikasis|exists:dokumen_customers,id',
        ]);
        Verifikasi::create(([
            'dokumen_customer_id' => $request->input('dokumen_customer_id'),
            'inspektur_id' => Inspektur::where('jabatan_id', '1')->first()->id,
            'status_id' => '6',
            'tanggal_mulai' => Carbon::now(),
        ]));

        DokumenCustomer::where('id', $request->input('dokumen_customer_id'))->update([
            'status_id' => '6',
        ]);

        return redirect()->route('admin.verifikasi.menunggu');
    }

    public function tolakMenunggu($dokumen)
    {
        DokumenCustomer::where('id', $dokumen)->update([
            'status_id' => '5',
        ]);

        return redirect()->route('admin.verifikasi.menunggu');
    }
}
