<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DokumenCustomer;
use App\Models\PenawaranHarga;
use App\Models\Pengajuan;
use App\Models\Verifikasi;
use App\Models\Inspektur;
use App\Models\Orders;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function adminDashboard() {
        $users = User::all();
        $totalUsers = $users->where('role_id',1)->count();
        $totalInspector = $users->where('role_id',3)->count();
        $dokumenCustomers = DokumenCustomer::all();
        $totalDokumenCustomers = $dokumenCustomers->where('status_id',3)->count();
        $needVerification = $dokumenCustomers->where('status_id',2)->count();
        $pengajuans = Pengajuan::all();
        $needSpecificApproval = $pengajuans->where('status_id', 1)->count();
        $penawaranHarga = PenawaranHarga::all();
        $totalTransaction = $penawaranHarga->count();
        $offeringApproval = $penawaranHarga->where('status_id', 4)->count();
        $orders = Orders::all();
        $totalSuccessOrders = $orders->where('status_order_id', 15)->count();


        return view('dashboard', compact('totalUsers', 'totalDokumenCustomers', 'totalInspector', 'needVerification', 'users', 'dokumenCustomers', 'needSpecificApproval', 'offeringApproval', 'totalSuccessOrders', 'totalTransaction'));
    }

    public function inspekturDashboard() {
        $inspekturId = auth()->user()->inspektur->id;
        $jabatanId = auth()->user()->inspektur->jabatan_id;

        if($jabatanId == 1) {
            $verifkasis = Verifikasi::where('inspektur_id', $inspekturId)->get();
        } else {
            $verifkasis = Verifikasi::where('inspektur2_id', $inspekturId)->get();
        }

        $needVerification1 = $verifkasis->where('status_id', 6)->count();
        $needVerification2 = $verifkasis->where('status_id', 7)->count();

        return view('dashboard', compact('needVerification1', 'needVerification2'));
    }

    public function customerDashboard() {
        $userId = auth()->user()->id;
        $dokumenCustomers = DokumenCustomer::where('user_id', $userId)->get();

        $pengajuans = Pengajuan::where('user_id', $userId)->get();
        $pengajuanId = $pengajuans->pluck('id');

        $penawaranHarga = PenawaranHarga::whereIn('pengajuan_id', $pengajuanId)->get();
        $penawaranHargaId = $penawaranHarga->pluck('id');
        $totalTransaction = $penawaranHarga->count();

        $needApproval = $penawaranHarga->where('status_id', 1)->count();
        $reSubmit = $penawaranHarga->where('status_id', 5)->count();
        
        $waitFOD = $penawaranHarga->where('dokumen', null)->where('status_id', 2)->count();
        $waitProcess = $penawaranHarga->filter(function ($ph) {
            return $ph->orders === null && $ph->dokumen !== null && $ph->status_id === 2;
        })->count();        

        $orders = Orders::whereIn('penawaran_id', $penawaranHargaId)->get();
        $totalSuccessOrders = $orders->where('status_order_id', 15)->count();
        

        return view('dashboard', compact('dokumenCustomers', 'needApproval', 'reSubmit', 'waitFOD', 'waitProcess', 'totalTransaction', 'totalSuccessOrders'));
    }
}
