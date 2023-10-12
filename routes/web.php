<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\InspekturController;
use App\Http\Controllers\DokumenCustomerController;
use App\Http\Controllers\VerifikasiController;
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
    });

    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('admin.dashboard');
        Route::get('/verifikasi/menunggu', [VerifikasiController::class, 'menungguVerifikasi'])->name('admin.verifikasi.menunggu');
        Route::get('/verifikasi/create/{dokumen}', [VerifikasiController::class, 'createVerifikasi'])->name('admin.verifikasi.create');
        Route::post('/verifikasi/store', [VerifikasiController::class, 'verifikasiAdmin'])->name('admin.verifikasi.store');
        Route::put('/verifikasi/tolak/{dokumen}', [VerifikasiController::class, 'tolakMenunggu'])->name('admin.verifikasi.tolak');
        Route::resource('jabatan', JabatanController::class);
        Route::resource('inspektur', InspekturController::class);
        Route::resource('verifikasi', VerifikasiController::class);
    });

    Route::middleware(['role:inspektur'])->prefix('inspektur')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('inspektur.dashboard');
    });
});

Route::middleware('auth','PreventBackHistory')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.edit.password');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
