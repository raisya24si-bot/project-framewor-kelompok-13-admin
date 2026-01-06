@extends('layouts.admin.app')

@section('title', 'Pembayaran')

@section('content')

<div class="page-header py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom bg-transparent p-0 mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="icon-grid"></i></a>
            </li>
            <li class="breadcrumb-item active">Pembayaran</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            <h3 class="font-weight-bold mb-1">Data Pembayaran</h3>
            <p class="text-muted mb-0">Daftar pembayaran peminjaman fasilitas.</p>
        </div>

        <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-success">
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
                        <th>Bukti</th>
                        <th>Resi</th>
                        <th>Keterangan</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($data as $item)

                    @php
                        $bukti = $item->media->where('caption', 'Bukti Pembayaran')->first();
                        $resi  = $item->media->where('caption', 'Resi Pembayaran')->first();
                    @endphp

                    <tr>
                        <td>{{ $item->peminjaman->warga->nama ?? '-' }}</td>
                        <td>{{ $item->peminjaman->fasilitas->nama ?? '-' }}</td>
                        <td>{{ $item->tanggal }}</td>

                        <td>{{ $item->jumlah_formatted }}</td>

                        <td>{{ $item->metode }}</td>

                        {{-- BUKTI --}}
                        <td>
                            @if($bukti)
                                <a href="{{ asset('storage/'.$bukti->file_url) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="ti-eye"></i> Lihat
                                </a>
                            @else
                                <span class="badge badge-light text-muted">
                                    Tidak ada
                                </span>
                            @endif
                        </td>

                        {{-- RESI --}}
                        <td>
                            @if($resi)
                                <a href="{{ asset('storage/'.$resi->file_url) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-success">
                                    <i class="ti-receipt"></i> Resi
                                </a>
                            @else
                                <span class="badge badge-light text-muted">
                                    Belum ada
                                </span>
                            @endif
                        </td>

                        <td>{{ $item->keterangan ?? '-' }}</td>

                        <td>
                            <a href="{{ route('admin.pembayaran.edit', $item->bayar_id) }}"
                               class="btn btn-primary btn-sm">
                                <i class="ti-pencil"></i>
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="9" class="text-muted py-4">
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
