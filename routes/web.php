<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasUmumController;
use App\Http\Controllers\SyaratFasilitasController;
use App\Http\Controllers\PetugasFasilitasController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PeminjamanFasilitasController;
use App\Http\Controllers\PembayaranFasilitasController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/ketua', function () {
    return view('ketua');
});

Route::get('/anggota', function () {
    return view('anggota');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::resource('fasilitas', FasilitasUmumController::class);

Route::resource('syarat', SyaratFasilitasController::class);

Route::resource('petugas', PetugasFasilitasController::class);

Route::resource('media', MediaController::class);

Route::resource('peminjaman', PeminjamanFasilitasController::class);

Route::resource('pembayaran', PembayaranFasilitasController::class);



