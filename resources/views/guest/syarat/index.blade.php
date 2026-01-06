@extends('layouts.guest.app')

@section('content')

    {{-- CSS KHUSUS HALAMAN SYARAT: MATIKAN EFEK BIRU --}}
    <style>
        /* 1. Paksa latar belakang tetap PUTIH saat di-hover */
        div.service-item:hover {
            background-color: #ffffff !important; 
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
            transform: translateY(-5px);
        }

        /* 2. Paksa Judul (h4) tetap HITAM saat di-hover */
        div.service-item:hover h4 {
            color: #000000 !important;
        }

        /* 3. Paksa Deskripsi (p) tetap ABU-ABU saat di-hover */
        div.service-item:hover p {
            color: #6c757d !important;
        }

        /* 4. Paksa Ikon tetap berwarna aslinya (Primary) */
        div.service-item:hover i {
            color: #0d6efd !important; /* Ganti dengan kode warna primary tema Anda jika beda */
        }
        
        /* 5. Pastikan teks kecil (small) tetap terbaca */
        div.service-item:hover small {
             color: #0d6efd !important;
        }
        
        div.service-item:hover small strong {
             color: #000 !important;
        }
    </style>

    {{-- HEADER --}}
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Syarat & Ketentuan</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">Mohon baca aturan peminjaman fasilitas.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-4">
                @forelse($items as $item)
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-light rounded p-4 shadow-sm h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fa fa-file-contract fa-2x text-primary me-3"></i>
                            <h4 class="mb-0">{{ $item->nama_syarat }}</h4>
                        </div>
                        
                        <p class="text-muted">{{ $item->deskripsi }}</p>
                        
                        <hr>
                        <small class="text-primary">
                            <i class="fa fa-building me-1"></i> Berlaku untuk: <strong>{{ $item->fasilitas->nama ?? 'Semua Fasilitas' }}</strong>
                        </small>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">Belum ada syarat khusus yang ditambahkan.</div>
                </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection