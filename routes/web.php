<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\InspekturController;
use App\Http\Controllers\DokumenCustomerController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\PenawaranHargaController;
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
        });
    });

    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('admin.dashboard');
        Route::group([''], function () {
            Route::get('/pengajuan', [PengajuanController::class, 'indexAdmin'])->name('admin.pengajuan.index');
            Route::get('/pengajuan/show/{pengajuan}', [PengajuanController::class, 'show'])->name('admin.pengajuan.show');
            Route::post('/pengajuan/approve/{pengajuan}', [PengajuanController::class, 'approve'])->name('admin.pengajuan.approve');
            Route::patch('/pengajuan/tolak/{pengajuan}', [PengajuanController::class, 'reject'])->name('admin.pengajuan.reject');
            Route::get('/pengajuan/process/{pengajuan}', [PengajuanController::class, 'reviewPengajuan'])->name('admin.pengajuan.process');
            
            Route::get('/penawaran-harga/create/{pengajuan}', [PenawaranHargaController::class, 'create'])->name('admin.penawaran-harga.create');
            Route::post('/penawaran-harga/store/{pengajuan}', [PenawaranHargaController::class, 'store'])->name('admin.penawaran-harga.store');
            Route::get('/penawaran-harga/show/{penawaran}', [PenawaranHargaController::class, 'show'])->name('admin.penawaran-harga.show');
            Route::patch('/penawaran-harga/reject/{penawaran}', [PenawaranHargaController::class, 'rejectAdmin'])->name('admin.penawaran-harga.reject');
            Route::get('/penawaran-harga/edit/{penawaran}', [PenawaranHargaController::class, 'edit'])->name('admin.penawaran-harga.edit');
            Route::patch('/penawaran-harga/update/{penawaran}', [PenawaranHargaController::class, 'update'])->name('admin.penawaran-harga.update');
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

require __DIR__.'/auth.php';
