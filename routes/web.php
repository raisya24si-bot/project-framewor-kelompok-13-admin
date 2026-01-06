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

// ========================
// PUBLIC
// ========================
Route::get('/', function () {
    return redirect()->route('login');
});

Route::view('/ketua', 'ketua');
Route::view('/anggota', 'anggota');

// ========================
// AUTH
// ========================
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

// ========================
// PROFILE (SEMUA USER LOGIN)
// ========================
Route::middleware('checkislogin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// ========================
// ADMIN + PETUGAS
// ========================
Route::middleware(['checkislogin', 'checkrole:admin,petugas'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('petugas', PetugasFasilitasController::class);
});

// ========================
// ADMIN ONLY
// ========================
Route::middleware(['checkislogin', 'checkrole:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('fasilitas', FasilitasUmumController::class);
        Route::resource('user', UserController::class);
        Route::resource('syarat', SyaratFasilitasController::class);
        Route::resource('media', MediaController::class);
        Route::resource('peminjaman', PeminjamanFasilitasController::class);
        Route::resource('pembayaran', PembayaranFasilitasController::class);
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