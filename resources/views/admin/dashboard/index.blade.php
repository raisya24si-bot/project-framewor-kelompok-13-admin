@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')

<div class="page-header py-4">
    <h3 class="font-weight-bold mb-3">Dashboard</h3>
    <p class="text-muted">Statistik Sistem Peminjaman Fasilitas Desa</p>
</div>

<div class="row">

    {{-- Total Fasilitas --}}
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h3 class="font-weight-bold">{{ \App\Models\FasilitasUmum::count() }}</h3>
                <p class="text-muted">Total Fasilitas</p>
            </div>
        </div>
    </div>

    {{-- Total Syarat --}}
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h3 class="font-weight-bold">{{ \App\Models\SyaratFasilitas::count() }}</h3>
                <p class="text-muted">Total Syarat</p>
            </div>
        </div>
    </div>

    {{-- Total Petugas --}}
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h3 class="font-weight-bold">{{ \App\Models\PetugasFasilitas::count() }}</h3>
                <p class="text-muted">Petugas Fasilitas</p>
            </div>
        </div>
    </div>

    {{-- Total Peminjaman --}}
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h3 class="font-weight-bold">{{ \App\Models\PeminjamanFasilitas::count() }}</h3>
                <p class="text-muted">Total Peminjaman</p>
            </div>
        </div>
    </div>

</div>

@endsection
