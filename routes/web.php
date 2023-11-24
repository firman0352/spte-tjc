<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\InspekturController;
use App\Http\Controllers\DokumenCustomerController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\PenawaranHargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\RfidController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        /** @var \App\User $user */
        $user = Auth::user();
        $routeName = "{$user->roleName()}.dashboard"; // Assumes your role column matches route names
        return redirect()->route($routeName);
    }
    return view('auth.login');
})->name('home');

// Route::get('/', function () {
//     return view('auth.login');
// })->name('/login')->middleware('auth');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');

Route::middleware(['auth', 'verified','PreventBackHistory'])->group(function () {
    Route::middleware(['role:customer'])->prefix('customer')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('customer.dashboard');
        Route::get('/dashboard', [DashboardController::class, 'customerDashboard'])->name('customer.dashboard');
        Route::put('/dokumen/verifikasi/{dokumen}', [DokumenCustomerController::class, 'verifikasi'])->name('dokumen.verifikasi');
        Route::resource('dokumen', DokumenCustomerController::class)->parameters([
            'dokumen' => 'dokumen' //mencegah parameter dokumen menjadi dokuman
        ]);
        Route::middleware(['verified.customer'])->group(function () {
            Route::get('pengajuan', [PengajuanController::class, 'indexCustomer'])->name('pengajuan.index');
            Route::get('pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
            Route::post('pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');

            Route::get('/penawaran-harga/show/{penawaran}', [PenawaranHargaController::class, 'show'])->name('penawaran-harga.show');
            Route::patch('/penawaran-harga/approve/{penawaran}', [PenawaranHargaController::class, 'approve'])->name('penawaran-harga.approve');
            Route::patch('/penawaran-harga/reject/{penawaran}', [PenawaranHargaController::class, 'reject'])->name('penawaran-harga.reject');
            Route::patch('/penawaran-harga/negotiate/{penawaran}', [PenawaranHargaController::class, 'negotiate'])->name('penawaran-harga.negotiate');

            Route::get('/orders', [OrdersController::class, 'customerIndex'])->name('orders.index');
            Route::get('/orders/show/{orders}', [OrdersController::class, 'show'])->name('orders.show');
            Route::get('/orders/update-kontrak/{orders}', [OrdersController::class, 'uploadKontrakCustomer'])->name('orders.upload-kontrak');
            Route::patch('/orders/update-kontrak/{orders}', [OrdersController::class, 'updateKontrakCustomer'])->name('orders.update-kontrak');
            Route::get('/orders/first-term/{orders}', [OrdersController::class, 'uploadPembayaranTerm1'])->name('orders.upload-1st-term');
            Route::patch('/orders/first-term/{orders}', [OrdersController::class, 'updatePembayaranTerm1'])->name('orders.update-1st-term');
            Route::get('/orders/second-term/{orders}', [OrdersController::class, 'uploadPembayaranTerm2'])->name('orders.upload-2nd-term');
            Route::patch('/orders/second-term/{orders}', [OrdersController::class, 'updatePembayaranTerm2'])->name('orders.update-2nd-term');
            Route::get('/orders/third-term/{orders}', [OrdersController::class, 'uploadPembayaranTerm3'])->name('orders.upload-3rd-term');
            Route::patch('/orders/third-term/{orders}', [OrdersController::class, 'updatePembayaranTerm3'])->name('orders.update-3rd-term');

            Route::get('/orders/update-completed/{orders}', [OrdersController::class, 'updateStatusComplete'])->name('orders.update-completed');
        });
    });

    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('admin.dashboard');
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::group([''], function () {
            Route::get('/pengajuan', [PengajuanController::class, 'indexAdmin'])->name('admin.pengajuan.index');
            Route::post('/pengajuan/approve/{pengajuan}', [PengajuanController::class, 'approve'])->name('admin.pengajuan.approve');
            Route::patch('/pengajuan/tolak/{pengajuan}', [PengajuanController::class, 'reject'])->name('admin.pengajuan.reject');
            Route::get('/pengajuan/process/{pengajuan}', [PengajuanController::class, 'reviewPengajuan'])->name('admin.pengajuan.process');
            
            Route::get('/penawaran-harga/create/{pengajuan}', [PenawaranHargaController::class, 'create'])->name('admin.penawaran-harga.create');
            Route::post('/penawaran-harga/store/{pengajuan}', [PenawaranHargaController::class, 'store'])->name('admin.penawaran-harga.store');
            Route::get('/penawaran-harga/show/{penawaran}', [PenawaranHargaController::class, 'show'])->name('admin.penawaran-harga.show');
            Route::patch('/penawaran-harga/reject/{penawaran}', [PenawaranHargaController::class, 'rejectAdmin'])->name('admin.penawaran-harga.reject');
            Route::get('/penawaran-harga/edit/{penawaran}', [PenawaranHargaController::class, 'edit'])->name('admin.penawaran-harga.edit');
            Route::patch('/penawaran-harga/update/{penawaran}', [PenawaranHargaController::class, 'update'])->name('admin.penawaran-harga.update');
            Route::get('/penawaran-harga/final/{penawaran}', [PenawaranHargaController::class, 'finalDokumen'])->name('admin.penawaran-harga.final');
            Route::patch('/penawaran-harga/final/{penawaran}', [PenawaranHargaController::class, 'storeFinalDokumen'])->name('admin.penawaran-harga.final.store');

            Route::get('/orders/create/{penawaran}', [OrdersController::class, 'create'])->name('admin.orders.create');
            Route::post('/orders/store/{penawaran}', [OrdersController::class, 'store'])->name('admin.orders.store');
            Route::get('/orders', [OrdersController::class, 'index'])->name('admin.orders.index');
            Route::get('/orders/{orders}', [OrdersController::class, 'show'])->name('admin.orders.show');
            // Status 1
            Route::get('/orders/first-invoice/{orders}', [OrdersController::class, 'uploadInvoice1'])->name('admin.orders.upload-1st-invoice');
            Route::patch('/orders/first-invoice/{orders}', [OrdersController::class, 'updateInvoice1'])->name('admin.orders.update-1st-invoice');
            Route::get('/orders/in-production/{orders}', [OrdersController::class, 'updateStatusInProduction'])->name('admin.orders.update-in-production');
            // Status 2
            Route::get('/orders/in-production/{orders}/upload', [OrdersController::class, 'uploadInProduction'])->name('admin.orders.upload-in-production');
            Route::post('/orders/in-production/{orders}/upload', [OrdersController::class, 'updateInProduction'])->name('admin.orders.store-in-production');
            Route::get('/orders/product-finished/{orders}', [OrdersController::class, 'updateStatusProductFinished'])->name('admin.orders.update-finished');
            // Status 3
            Route::get('/orders/product-finished/{orders}/upload', [OrdersController::class, 'uploadProductFinished'])->name('admin.orders.upload-finished');
            Route::post('/orders/product-finished/{orders}/upload', [OrdersController::class, 'updateProductFinished'])->name('admin.orders.store-finished');
            Route::get('/orders/test-lab/{orders}/upload', [OrdersController::class, 'uploadTestLab'])->name('admin.orders.upload-test-lab');
            Route::patch('/orders/test-lab/{orders}/upload', [OrdersController::class, 'updateTestLab'])->name('admin.orders.store-test-lab');
            // Status 4
            Route::get('/orders/second-invoice/{orders}', [OrdersController::class, 'uploadInvoice2'])->name('admin.orders.upload-2nd-invoice');
            Route::patch('/orders/second-invoice/{orders}', [OrdersController::class, 'updateInvoice2'])->name('admin.orders.update-2nd-invoice');

            Route::get('/orders/product-packing/{orders}', [OrdersController::class, 'uploadProductPacking'])->name('admin.orders.upload-packing');
            Route::post('/orders/product-packing/{orders}', [OrdersController::class, 'updateProductPacking'])->name('admin.orders.store-packing');
            Route::get('/orders/shipping-doc/{orders}', [OrdersController::class, 'uploadDokumenShipping'])->name('admin.orders.upload-shipping');
            Route::patch('/orders/shipping-doc/{orders}', [OrdersController::class, 'updateDokumenShipping'])->name('admin.orders.store-shipping');
            
            Route::get('/orders/third-invoice/{orders}', [OrdersController::class, 'uploadInvoice3'])->name('admin.orders.upload-3rd-invoice');
            Route::patch('/orders/third-invoice/{orders}', [OrdersController::class, 'updateInvoice3'])->name('admin.orders.update-3rd-invoice');

            Route::get('/orders/product-container/{orders}', [OrdersController::class, 'uploadShippingContainer'])->name('admin.orders.upload-container');
            Route::post('/orders/product-container/{orders}', [OrdersController::class, 'updateShippingContainer'])->name('admin.orders.store-container');
            Route::get('/orders/bill-of-lading/{orders}', [OrdersController::class, 'uploadBOL'])->name('admin.orders.upload-bill-of-lading');
            Route::patch('/orders/bill-of-lading/{orders}', [OrdersController::class, 'updateBOL'])->name('admin.orders.store-bill-of-lading');

            Route::get('/orders/product-arrived/{orders}', [OrdersController::class, 'updateStatusDelivered'])->name('admin.orders.update-arrived');
        });
        Route::group([''], function () {
            Route::get('/verifikasi/menunggu', [VerifikasiController::class, 'menungguVerifikasi'])->name('admin.verifikasi.menunggu');
            Route::get('/verifikasi/create/{dokumen}', [VerifikasiController::class, 'createVerifikasi'])->name('admin.verifikasi.create');
            Route::post('/verifikasi/store', [VerifikasiController::class, 'verifikasiAdmin'])->name('admin.verifikasi.store');
            Route::put('/verifikasi/tolak/{dokumen}', [VerifikasiController::class, 'tolakMenunggu'])->name('admin.verifikasi.tolak');
            Route::get('/verifikasi/history', [VerifikasiController::class,'history'])->name('verifikasi.history');
            Route::get('/verifikasi', [VerifikasiController::class,'index'])->name('verifikasi.index');
            Route::resource('verifikasi', VerifikasiController::class);
        });
        Route::resource('jabatan', JabatanController::class);
        Route::resource('inspektur', InspekturController::class);
    });

    Route::middleware(['role:inspektur'])->prefix('inspektur')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('inspektur.dashboard');
        Route::get('/dashboard', [DashboardController::class, 'inspekturDashboard'])->name('inspektur.dashboard');
        Route::get('/verifikasi', [VerifikasiController::class, 'indexInspektur'])->name('inspektur.verifikasi.index');
        Route::get('/verifikasi/show/{verifikasi}', [VerifikasiController::class, 'showInspektur'])->name('inspektur.verifikasi.show');
        Route::patch('/verifikasi/{verifikasi}', [VerifikasiController::class, 'approveInspektur'])->name('inspektur.verifikasi.approve');
        Route::patch('/verifikasi/tolak/{verifikasi}', [VerifikasiController::class, 'rejectInspektur'])->name('inspektur.verifikasi.reject');
    });
});

Route::middleware('auth','PreventBackHistory')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.edit.password');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//* RFID *//
Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/rfid', [RfidController::class, 'show']);
        Route::get('/location', [RfidController::class, 'getLocation']);
    });

    Route::get('/location/{rfid_tag}', [RfidController::class, 'findLocation']);
});

require __DIR__.'/auth.php';
