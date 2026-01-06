@extends('layouts.guest.app')

@section('content')

    {{-- HEADER --}}
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Petugas Fasilitas</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">Hubungi petugas kami jika butuh bantuan.</p>
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
                            <label class="form-label fw-bold">Cari Petugas</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa fa-search text-primary"></i></span>
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Nama petugas atau fasilitas..." 
                                       value="{{ request('search') }}">
                            </div>
                        </div>

                        {{-- 2. Dropdown Filter Jabatan --}}
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Jabatan</label>
                            <select name="peran" class="form-select">
                                <option value="">Semua Jabatan</option>
                                @if(isset($listPeran))
                                    @foreach($listPeran as $peran)
                                        <option value="{{ $peran }}" {{ request('peran') == $peran ? 'selected' : '' }}>
                                            {{ ucfirst($peran) }}
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
                    <div class="team-item bg-light rounded p-4 text-center shadow-sm h-100">
                        <div class="mb-3">
                           <i class="fa fa-user-tie fa-3x text-primary"></i>
                        </div>
                        
                        <h4 class="mb-0">{{ $item->warga->nama ?? 'Nama Petugas' }}</h4>
                        <small class="text-muted">{{ $item->peran }}</small>
                        
                        <div class="mt-3">
                            <p class="mb-1"><strong>Bertanggung Jawab di:</strong></p>
                            <p class="text-primary">{{ $item->fasilitas->nama ?? 'Semua Fasilitas' }}</p>
                            
                            @if(isset($item->warga) && isset($item->warga->telp))
                                <a href="https://wa.me/{{ $item->warga->telp }}" target="_blank" class="btn btn-sm btn-success mt-2">
                                    <i class="fab fa-whatsapp me-2"></i>Hubungi Petugas
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">
                        Tidak ada petugas yang ditemukan dengan kriteria pencarian tersebut.
                    </div>
                </div>
                @endforelse

            </div>
            
            {{-- PAGINATION YANG DIPERBAIKI (PASTI TENGAH) --}}
            <div class="d-flex justify-content-center w-100 mt-5">
                <style> .pagination { justify-content: center !important; } </style>
                {{ $items->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
            
        </div>
    </div>

@endsection