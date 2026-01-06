@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')

{{-- ================= HEADER / WELCOME ================= --}}
<div class="row mb-4">
    <div class="col-md-8">
        <h3 class="font-weight-bold mb-1">
            Selamat Datang, {{ Auth::user()->name }} 👋
        </h3>
        <p class="text-muted">
            Berikut ringkasan aktivitas peminjaman fasilitas desa hari ini.
        </p>
    </div>
    <div class="col-md-4 text-md-right mt-3 mt-md-0">
        <span class="badge badge-light px-3 py-2">
            {{ now()->format('l, d M Y') }}
        </span>
    </div>
</div>

{{-- ================= HERO CARD (GAMBAR + INFO) ================= --}}
<div class="row mb-5">
    <div class="col-12">
        <div class="card card-tale overflow-hidden">
            <div class="card-body p-0">
                <div class="row no-gutters align-items-center">

                    {{-- GAMBAR --}}
                    <div class="col-md-6">
                        <img
                            src="{{ asset('assets/dashboard/welcome.png') }}"
                            alt="Dashboard"
                            class="img-fluid"
                            style="height:100%; object-fit:cover;"
                        >
                    </div>

                    {{-- TEKS --}}
                    <div class="col-md-6 p-4 text-white">
                         <small class="text-white-50 d-block mb-2">
                    Dashboard Administrasi
                        </small>

                    <h4 class="font-weight-bold mb-3">
                      Manajemen Fasilitas Umum Desa
                     </h4>

                 <p class="mb-4" style="max-width:420px; line-height:1.7;">
                    Panel administrasi untuk mengelola data fasilitas umum,
                    persyaratan peminjaman, petugas, dan aktivitas peminjaman
                    secara terpusat.
                    </p>

                       <div class="d-flex flex-column">
                   <span class="mb-2">
                  <i class="ti-check mr-2"></i>
                      Pengelolaan fasilitas & persyaratan
                  </span>
                   <span class="mb-2">
                   <i class="ti-check mr-2"></i>
                       Monitoring peminjaman fasilitas
                  </span>
                     <span>
                       <i class="ti-check mr-2"></i>
                        Manajemen petugas fasilitas desa
                    </span>
                 </div>

                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================= CARD STATISTIK ================= --}}
<div class="row">

    <div class="col-md-3 mb-4">
        <div class="card card-tale">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1">Total Fasilitas</p>
                    <h3 class="font-weight-bold mb-0">
                        {{ \App\Models\FasilitasUmum::count() }}
                    </h3>
                    <small class="text-white-50">Fasilitas tersedia</small>
                </div>
                <i class="ti-home icon-lg text-white"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-dark-blue">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1">Total Syarat</p>
                    <h3 class="font-weight-bold mb-0">
                        {{ \App\Models\SyaratFasilitas::count() }}
                    </h3>
                    <small class="text-white-50">Syarat aktif</small>
                </div>
                <i class="ti-list icon-lg text-white"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-light-blue">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1">Petugas Fasilitas</p>
                    <h3 class="font-weight-bold mb-0">
                        {{ \App\Models\PetugasFasilitas::count() }}
                    </h3>
                    <small class="text-white-50">Petugas terdaftar</small>
                </div>
                <i class="ti-user icon-lg text-white"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-light-danger">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1">Total Peminjaman</p>
                    <h3 class="font-weight-bold mb-0">
                        {{ \App\Models\PeminjamanFasilitas::count() }}
                    </h3>
                    <small class="text-white-50">Data peminjaman</small>
                </div>
                <i class="ti-clipboard icon-lg text-white"></i>
            </div>
        </div>
    </div>

</div>

{{-- ================= CHART + TABLE ================= --}}
<div class="row mt-4">

    {{-- DONUT --}}
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Distribusi Fasilitas Berdasarkan Jenis</h5>
                <p class="text-muted mb-4">
                    Persentase jumlah fasilitas desa berdasarkan jenis fasilitas.
                </p>

                <div style="height:260px;">
                    <canvas id="donutFasilitas"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Peminjaman Terbaru</h5>
                <p class="text-muted mb-3">
                    Aktivitas peminjaman fasilitas terbaru oleh warga.
                </p>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Warga</th>
                                <th>Fasilitas</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($peminjamanTerbaru as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->warga->nama ?? '-' }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            {{ $item->created_at->diffForHumans() }}
                                        </small>
                                    </td>
                                    <td>{{ $item->fasilitas->nama ?? '-' }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M') }}
                                        →
                                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = match(strtolower($item->status)) {
                                                'disetujui' => 'badge-success',
                                                'pending'   => 'badge-warning',
                                                'ditolak'   => 'badge-danger',
                                                'selesai'   => 'badge-info',
                                                default     => 'badge-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Belum ada peminjaman
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('donutFasilitas').getContext('2d');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: @json($labelFasilitas),
            datasets: [{
                data: @json($donutFasilitas),
                backgroundColor: [
                    '#4B49AC',
                    '#98BDFF',
                    '#FFC100',
                    '#F3797E'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 15
                    }
                }
            }
        }
    });
});
</script>
@endpush
