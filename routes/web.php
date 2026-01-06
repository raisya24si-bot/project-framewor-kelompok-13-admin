<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasUmumController;
use App\Http\Controllers\SyaratFasilitasController;
use App\Http\Controllers\PetugasFasilitasController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PeminjamanFasilitasController;
use App\Http\Controllers\PembayaranFasilitasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

// ------------------------
// HALAMAN PUBLIC
// ------------------------
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/ketua', function () {
    return view('ketua');
});

Route::get('/anggota', function () {
    return view('anggota');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


// ------------------------
// AUTH (LOGIN / LOGOUT)
// ------------------------
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::middleware(['checkislogin'])->group(function () {

    // ========================
    // ADMIN & PETUGAS
    // ========================
    Route::middleware(['checkrole:admin,petugas'])->group(function () {
        Route::resource('petugas', PetugasFasilitasController::class);
    });

    // ========================
    // ADMIN ONLY
    // ========================
    Route::middleware(['checkrole:admin'])->group(function () {

        Route::resource('user', UserController::class);
        Route::resource('fasilitas', FasilitasUmumController::class);
        Route::resource('syarat', SyaratFasilitasController::class);
        Route::resource('media', MediaController::class);
        Route::resource('peminjaman', PeminjamanFasilitasController::class);
        Route::resource('pembayaran', PembayaranFasilitasController::class);

        // 🔥 MEDIA VIEW (ADMIN ONLY)
        Route::get('/media/view/{id}', [MediaController::class, 'view'])
            ->name('media.view');
    });

});

//bagian guest 
// Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'guestIndex'])->name('guest.dashboard');

// Menu Tamu Lainnya
Route::get('/fasilitas',  [FasilitasUmumController::class, 'guestIndex'])->name('guest.fasilitas');
Route::get('/pembayaran', [PembayaranFasilitasController::class, 'guestIndex'])->name('guest.pembayaran');
Route::get('/peminjaman', [PeminjamanFasilitasController::class, 'guestIndex'])->name('guest.peminjaman');
Route::get('/petugas',    [PetugasFasilitasController::class, 'guestIndex'])->name('guest.petugas');
Route::get('/syarat',     [SyaratFasilitasController::class, 'guestIndex'])->name('guest.syarat');