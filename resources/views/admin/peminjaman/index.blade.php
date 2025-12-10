@extends('layouts.admin.app')

@section('title', 'Peminjaman Fasilitas')

@section('content')

<div class="page-header py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom bg-transparent p-0 mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}"><i class="icon-grid"></i></a>
            </li>
            <li class="breadcrumb-item active">Peminjaman Fasilitas</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            <h3 class="font-weight-bold mb-1">Data Peminjaman Fasilitas</h3>
            <p class="text-muted mb-0">List peminjaman fasilitas oleh warga.</p>
        </div>

        {{-- FIX ROUTE NAME --}}
        <a href="{{ route('peminjaman.create') }}" class="btn btn-success btn-icon-text">
            <i class="ti-plus btn-icon-prepend"></i> Tambah Peminjaman
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
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
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Tujuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $item->warga->nama ?? '-' }}</td>
                            <td>{{ $item->fasilitas->nama ?? '-' }}</td>

                            <td>
                                {{ $item->tanggal_mulai }} → {{ $item->tanggal_selesai }}
                            </td>

                            <td>
                                <span class="badge badge-{{ 
                                    $item->status == 'pending' ? 'warning' :
                                    ($item->status == 'disetujui' ? 'success' :
                                    ($item->status == 'ditolak' ? 'danger' : 'info'))
                                }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <td>{{ $item->tujuan }}</td>

                            <td>
                                {{-- FIX ROUTE NAME --}}
                                <a href="{{ route('peminjaman.edit', $item->pinjam_id) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="ti-pencil"></i>
                                </a>

                                {{-- FIX ROUTE NAME --}}
                                <form action="{{ route('peminjaman.destroy', $item->pinjam_id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        <i class="ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-muted py-4">Belum ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection
