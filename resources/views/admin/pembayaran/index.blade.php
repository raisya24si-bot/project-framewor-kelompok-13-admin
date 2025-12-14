@extends('layouts.admin.app')

@section('title', 'Pembayaran')

@section('content')

{{-- ===========================
     HEADER
============================ --}}
<div class="page-header py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom bg-transparent p-0 mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}"><i class="icon-grid"></i></a>
            </li>
            <li class="breadcrumb-item active">Pembayaran</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            <h3 class="font-weight-bold mb-1">Data Pembayaran</h3>
            <p class="text-muted mb-0">Daftar pembayaran peminjaman fasilitas.</p>
        </div>

        {{-- tombol tambah (opsional) --}}
        <a href="{{ route('pembayaran.create') }}" class="btn btn-success">
            <i class="ti-plus"></i> Tambah Pembayaran
        </a>
    </div>
</div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif

{{-- ===========================
     TABLE
============================ --}}
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover text-center align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>Warga</th>
                        <th>Fasilitas</th>
                        <th>Tanggal Bayar</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $item->peminjaman->warga->nama ?? '-' }}</td>
                        <td>{{ $item->peminjaman->fasilitas->nama ?? '-' }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>Rp {{ number_format($item->jumlah,0,',','.') }}</td>
                        <td>{{ $item->metode }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td>
                            <a href="{{ route('pembayaran.edit', $item->bayar_id) }}"
                               class="btn btn-primary btn-sm">
                                <i class="ti-pencil"></i> Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-muted py-4">
                            Belum ada data pembayaran.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $data->links() }}
        </div>
    </div>
</div>

@endsection
