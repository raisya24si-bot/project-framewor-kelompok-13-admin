@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')

{{-- HEADER --}}
<div class="page-header py-4">
    <h3 class="font-weight-bold mb-1">Dashboard</h3>
    <p class="text-muted">
        Statistik Sistem Peminjaman Fasilitas Desa
    </p>
</div>

{{-- CARD RINGKASAN --}}
<div class="row">

    <div class="col-md-3 mb-4">
        <div class="card card-tale">
            <div class="card-body">
                <p class="mb-2">Total Fasilitas</p>
                <h3 class="font-weight-bold">
                    {{ \App\Models\FasilitasUmum::count() }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-dark-blue">
            <div class="card-body">
                <p class="mb-2">Total Syarat</p>
                <h3 class="font-weight-bold">
                    {{ \App\Models\SyaratFasilitas::count() }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-light-blue">
            <div class="card-body">
                <p class="mb-2">Petugas Fasilitas</p>
                <h3 class="font-weight-bold">
                    {{ \App\Models\PetugasFasilitas::count() }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-light-danger">
            <div class="card-body">
                <p class="mb-2">Total Peminjaman</p>
                <h3 class="font-weight-bold">
                    {{ \App\Models\PeminjamanFasilitas::count() }}
                </h3>
            </div>
        </div>
    </div>

</div>
<div class="row mt-4">

    {{-- DONUT --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Distribusi Fasilitas Berdasarkan Jenis</h5>
                <p class="text-muted mb-4">
                    Grafik ini menampilkan persentase jumlah fasilitas desa berdasarkan jenis fasilitas.
                </p>

                <div style="height:260px;">
                    <canvas id="donutFasilitas"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL PEMINJAMAN --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Peminjaman Terbaru</h5>
                <p class="text-muted mb-3">
                    Daftar peminjaman fasilitas terbaru oleh warga.
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
                                    <td>{{ $item->warga->nama ?? '-' }}</td>
                                    <td>{{ $item->fasilitas->nama ?? '-' }}</td>
                                    <td>
                                        {{ $item->tanggal_mulai }}
                                        →
                                        {{ $item->tanggal_selesai }}
                                    </td>
                                    <td>
                                        @php
                                            $status = strtolower($item->status);

                                            $statusClass = match($status) {
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
