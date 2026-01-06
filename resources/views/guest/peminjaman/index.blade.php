@extends('layouts.guest.app')

@section('content')

    {{-- HEADER --}}
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Status Peminjaman</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">Agenda kegiatan warga dan penggunaan fasilitas desa.</p>
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
                        
                        {{-- 1. Input Cari Kegiatan --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Cari Kegiatan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa fa-search text-primary"></i></span>
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Nama acara atau kegiatan..." 
                                       value="{{ request('search') }}">
                            </div>
                        </div>

                        {{-- 2. Dropdown Filter Status --}}
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Status Pengajuan</label>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        {{-- 3. Tombol Terapkan --}}
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
                
                @forelse($peminjaman as $item)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-item bg-light rounded overflow-hidden shadow-sm h-100">
                        
                        <div class="blog-img position-relative overflow-hidden">
                            
                           @php
                            // Gambar logic
                            $fotoUrl = asset('fasilitas-guest/img/blog-1.jpg'); 
                            if($item->fasilitas && $item->fasilitas->foto() && isset($item->fasilitas->foto()->file_url)) {
                                $fotoUrl = asset('storage/' . $item->fasilitas->foto()->file_url); 
                            }
                            @endphp

                            <img class="img-fluid w-100" 
                                 src="{{ $fotoUrl }}" 
                                 alt="Fasilitas" 
                                 style="height: 200px; object-fit: cover;">

                            <div class="position-absolute top-0 start-0 bg-primary text-white text-center rounded-end py-2 px-4 mt-4">
                                <h3 class="m-0 text-white">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d') }}</h3>
                                <small>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('M Y') }}</small>
                            </div>
                        </div>

                        <div class="p-4">
                            
                            <div class="d-flex mb-3">
                                <small class="me-3 text-muted">
                                    <i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $item->fasilitas->nama ?? 'Lokasi Umum' }}
                                </small>
                                <small class="text-muted">
                                    <i class="fa fa-clock text-primary me-2"></i>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('H:i') }} WIB
                                </small>
                            </div>
                            
                            <h4 class="mb-3">{{ Str::limit($item->tujuan, 45) }}</h4>
                            
                            <p class="text-muted">
                                Oleh: <strong>{{ $item->warga->nama ?? 'Warga Desa' }}</strong>
                            </p>

                            @php
                                 $status = strtolower($item->status);
                            @endphp

                            @if($status === 'disetujui')
                              <span class="badge bg-success">
                                    <i class="fa fa-check-circle me-1"></i> Disetujui
                            </span>
                            @elseif($status === 'pending')
                            <span class="badge bg-warning text-dark">
                            <i class="fa fa-hourglass-half me-1"></i> Menunggu
                            </span>
                            @else
                            <span class="badge bg-danger">
                                <i class="fa fa-times-circle me-1"></i> Ditolak
                            </span>
                        @endif


                        </div>
                    </div>
                </div>
                
                @empty
                <div class="col-12 text-center py-5">
                    <div class="bg-light rounded p-5 border border-dashed">
                        <i class="fa fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum ada agenda kegiatan yang sesuai filter.</h4>
                        <p class="text-muted">Coba ubah kata kunci atau status pencarian Anda.</p>
                    </div>
                </div>
                @endforelse

            </div>
            
            {{-- PAGINATION YANG DIPERBAIKI (PASTI TENGAH) --}}
            <div class="d-flex justify-content-center w-100 mt-5">
                <style> .pagination { justify-content: center !important; } </style>
                {{ $peminjaman->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

@endsection