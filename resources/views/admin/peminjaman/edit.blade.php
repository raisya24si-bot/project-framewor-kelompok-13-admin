@extends('layouts.admin.app')

@section('title', 'Edit Peminjaman')

@section('content')

<div class="page-header py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom bg-transparent p-0 mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}"><i class="icon-grid"></i></a>
            </li>

            {{-- FIX ROUTE NAME --}}
            <li class="breadcrumb-item">
                <a href="{{ route('peminjaman.index') }}">Peminjaman</a>
            </li>

            <li class="breadcrumb-item active">Edit Peminjaman</li>
        </ol>
    </nav>

    <h3 class="font-weight-bold mt-3">Edit Data Peminjaman</h3>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        {{-- FIX ROUTE NAME --}}
        <form action="{{ route('peminjaman.update', $data->pinjam_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                {{-- Warga --}}
                <div class="col-md-6 mb-3">
                    <label>Warga</label>
                    <select name="warga_id" class="form-control">
                        @foreach($warga as $item)
                            <option value="{{ $item->warga_id }}"
                                {{ $data->warga_id == $item->warga_id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Fasilitas --}}
                <div class="col-md-6 mb-3">
                    <label>Fasilitas</label>
                    <select name="fasilitas_id" class="form-control">
                        @foreach($fasilitas as $item)
                            <option value="{{ $item->fasilitas_id }}"
                                {{ $data->fasilitas_id == $item->fasilitas_id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal Mulai --}}
                <div class="col-md-6 mb-3">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control"
                        value="{{ $data->tanggal_mulai }}">
                </div>

                {{-- Tanggal Selesai --}}
                <div class="col-md-6 mb-3">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control"
                        value="{{ $data->tanggal_selesai }}">
                </div>

                {{-- Tujuan --}}
                <div class="col-md-12 mb-3">
                    <label>Tujuan</label>
                    <textarea name="tujuan" class="form-control" rows="3">{{ $data->tujuan }}</textarea>
                </div>

                {{-- Status --}}
                <div class="col-md-12 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="disetujui" {{ $data->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ $data->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="selesai" {{ $data->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

            </div>

            <div class="d-flex justify-content-end">
                {{-- FIX ROUTE --}}
                <a href="{{ route('peminjaman.index') }}" class="btn btn-light mr-2">Batal</a>
                <button class="btn btn-primary">Update</button>
            </div>

        </form>

    </div>
</div>

@endsection
