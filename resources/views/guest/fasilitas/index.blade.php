@extends('layouts.guest.app')

@section('content')

    {{-- HEADER --}}
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Daftar Fasilitas Desa</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">Temukan fasilitas umum yang tersedia untuk warga.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- >>> FITUR PENCARIAN & FILTER <<< --}}
    <div class="container-fluid mb-4" style="margin-top: -50px; position: relative; z-index: 2;">
        <div class="container">
            <div class="bg-white p-4 rounded shadow">
                <form action="{{ url()->current() }}" method="GET">
                    <div class="row g-3 align-items-end">
                        
                        {{-- 1. Input Pencarian --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Cari Fasilitas</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa fa-search text-primary"></i></span>
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Nama fasilitas atau alamat..." 
                                       value="{{ request('search') }}">
                            </div>
                        </div>

                        {{-- 2. Dropdown Filter RT --}}
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Filter Wilayah</label>
                            <select name="rt" class="form-select">
                                <option value="">Semua Wilayah (RT)</option>
                                @if(isset($listRT))
                                    @foreach($listRT as $rt)
                                        <option value="{{ $rt }}" {{ request('rt') == $rt ? 'selected' : '' }}>
                                            RT {{ $rt }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        {{-- 3. Tombol Cari --}}
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
                    <div class="bg-light rounded h-100 p-4 shadow-sm">
                        
                        {{-- GAMBAR --}}
                        <div class="mb-4 position-relative overflow-hidden">
                            @php
                                $fotoUrl = asset('fasilitas-guest/img/blog-1.jpg'); 
                                if($item->foto() && isset($item->foto()->file_url)) {
                                    $fotoUrl = asset('storage/' . $item->foto()->file_url); 
                                }
                            @endphp

                            <img src="{{ $fotoUrl }}" 
                                 class="img-fluid w-100 rounded" 
                                 alt="{{ $item->nama }}"
                                 style="height: 250px; object-fit: cover;">
                        </div>

                        {{-- INFO --}}
                        <div class="d-flex justify-content-between mb-3">
                            <small class="text-primary"><i class="fa fa-map-marker-alt me-2"></i>RT {{ $item->rt ?? '-' }}</small>
                            <small class="text-primary"><i class="fa fa-users me-2"></i>{{ $item->kapasitas }} Orang</small>
                        </div>
                        
                        <h4 class="mb-3">{{ $item->nama }}</h4>
                        <p class="text-muted">{{ Str::limit($item->deskripsi, 80) }}</p>
                        
                        <div class="d-flex border-top mt-4 pt-4">
                            <div class="ms-auto">
                                <a class="btn btn-primary px-3" href="#">Lihat Detail <i class="fa fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">
                        Tidak ada fasilitas yang ditemukan.
                    </div>
                </div>
                @endforelse

            </div> 

            {{-- >>> PAGINATION YANG DIPERBAIKI <<< --}}
            <div class="d-flex justify-content-center w-100 mt-5">
                <style> .pagination { justify-content: center !important; } </style>
                {{ $items->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

@endsection