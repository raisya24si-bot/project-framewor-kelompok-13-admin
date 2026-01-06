@extends('layouts.guest.app')

@section('content')

    {{-- CSS Fix --}}
    <style>
        .blog-item:hover .blog-img img {
            transform: none !important;
            transition: none !important;
        }
        .blog-item .position-absolute {
            z-index: 99; 
        }
        /* Style tambahan untuk pagination di tengah */
        .pagination { justify-content: center !important; }
    </style>

    {{-- HEADER --}}
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Riwayat Transaksi</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">Data pembayaran retribusi penggunaan fasilitas desa.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- >>> FITUR PENCARIAN & FILTER (BARU) <<< --}}
    <div class="container-fluid mb-4" style="margin-top: -50px; position: relative; z-index: 2;">
        <div class="container">
            <div class="bg-white p-4 rounded shadow">
                <form action="{{ url()->current() }}" method="GET">
                    <div class="row g-3 align-items-end">
                        
                        {{-- 1. Input Pencarian --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Cari Transaksi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa fa-search text-primary"></i></span>
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Nama warga atau fasilitas..." 
                                       value="{{ request('search') }}">
                            </div>
                        </div>

                        {{-- 2. Dropdown Filter Metode --}}
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Metode Pembayaran</label>
                            <select name="metode" class="form-select">
                                <option value="">Semua Metode</option>
                                @if(isset($listMetode))
                                    @foreach($listMetode as $metode)
                                        <option value="{{ $metode }}" {{ request('metode') == $metode ? 'selected' : '' }}>
                                            {{ ucfirst($metode) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        {{-- 3. Tombol Submit --}}
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100 fw-bold">
                                Terapkan
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END PENCARIAN --}}

    {{-- CONTENT --}}
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-4">
                
               @forelse($items as $item)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-item bg-light rounded overflow-hidden shadow-sm h-100">
                        
                        <div class="blog-img position-relative overflow-hidden">
                            @php
                                $fotoUrl = asset('fasilitas-guest/img/blog-1.jpg'); 
                                if($item->peminjaman && $item->peminjaman->fasilitas && $item->peminjaman->fasilitas->foto() && isset($item->peminjaman->fasilitas->foto()->file_url)) {
                                    $fotoUrl = asset('storage/' . $item->peminjaman->fasilitas->foto()->file_url); 
                                }
                            @endphp
                            
                            <img class="img-fluid w-100" src="{{ $fotoUrl }}" alt="Foto Fasilitas" style="height: 200px; object-fit: cover;">
                            
                            <div class="position-absolute top-0 start-0 bg-primary text-white text-center rounded-end py-2 px-4 mt-4">
                                <h3 class="m-0 text-white">{{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</h3>
                                <small>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('M Y') }}</small>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <div class="d-flex mb-3">
                                <small class="me-3 text-muted">
                                    <i class="fa fa-user text-primary me-2"></i>{{ $item->peminjaman->warga->nama ?? 'Warga' }}
                                </small>
                                <small class="text-muted">
                                    <i class="fa fa-tag text-primary me-2"></i>{{ $item->metode ?? 'Tunai' }}
                                </small>
                            </div>
                            
                            <h4 class="mb-2">
                                {{ Str::limit($item->peminjaman->fasilitas->nama ?? 'Fasilitas Desa', 40) }}
                            </h4>

                            <h3 class="text-primary fw-bold mb-3">
                                Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                            </h3>
                            
                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <div>
                                    {{-- Status Bayar --}}
                                    <span class="badge bg-success"><i class="fa fa-check-circle me-1"></i> Terbayar</span>
                                </div>
                                <small class="text-muted">ID: #{{ $item->bayar_id }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="bg-light rounded p-5 border border-dashed">
                        <i class="fa fa-money-bill-wave fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Tidak ada data pembayaran ditemukan.</h4>
                        <p class="text-muted">Cobalah ubah kata kunci pencarian atau metode pembayaran.</p>
                    </div>
                </div>
                @endforelse

            </div>
            
            {{-- PAGINATION YANG DIPERBAIKI (PASTI TENGAH) --}}
            <div class="d-flex justify-content-center w-100 mt-5">
                {{ $items->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

@endsection