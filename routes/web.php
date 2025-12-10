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


// ------------------------
// HALAMAN PUBLIC
// ------------------------
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/ketua', function () {
    return view('ketua');
});

Route::get('/anggota', function () {
    return view('anggota');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
})->name('dashboard');


// ------------------------
// AUTH (LOGIN / LOGOUT)
// ------------------------
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::middleware(['checkislogin'])->group(function () {

    Route::middleware(['checkrole:admin,petugas'])->group(function () {
        Route::resource('petugas', PetugasFasilitasController::class);
    });

    Route::middleware(['checkrole:admin'])->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('fasilitas', FasilitasUmumController::class);
        Route::resource('syarat', SyaratFasilitasController::class);
        Route::resource('media', MediaController::class);
        Route::resource('peminjaman', PeminjamanFasilitasController::class);
        Route::resource('pembayaran', PembayaranFasilitasController::class);
    });

});
