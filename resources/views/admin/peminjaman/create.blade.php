@extends('layouts.admin.app')

@section('title', 'Tambah Peminjaman')

@section('content')

<div class="page-header py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom bg-transparent p-0 mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}"><i class="icon-grid"></i></a>
            </li>

            {{-- FIX ROUTE --}}
            <li class="breadcrumb-item">
                <a href="{{ route('peminjaman.index') }}">Peminjaman</a>
            </li>

            <li class="breadcrumb-item active">Tambah Peminjaman</li>
        </ol>
    </nav>

    <h3 class="font-weight-bold mt-3">Tambah Peminjaman Fasilitas</h3>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        {{-- FIX ROUTE --}}
        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf

            <div class="row">

                {{-- Warga --}}
                <div class="col-md-6 mb-3">
                    <label>Warga</label>
                    <select name="warga_id" class="form-control">
                        @foreach($warga as $item)
                            <option value="{{ $item->warga_id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Fasilitas --}}
                <div class="col-md-6 mb-3">
                    <label>Fasilitas</label>
                    <select name="fasilitas_id" class="form-control">
                        @foreach($fasilitas as $item)
                            <option value="{{ $item->fasilitas_id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal Mulai --}}
                <div class="col-md-6 mb-3">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control">
                </div>

                {{-- Tanggal Selesai --}}
                <div class="col-md-6 mb-3">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control">
                </div>

                {{-- Tujuan --}}
                <div class="col-md-12 mb-3">
                    <label>Tujuan</label>
                    <textarea name="tujuan" class="form-control" rows="3"></textarea>
                </div>

                {{-- Status --}}
                <div class="col-md-12 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('peminjaman.index') }}" class="btn btn-light mr-2">Batal</a>
                <button class="btn btn-success">Simpan</button>
            </div>

        </form>

    </div>
</div>

@endsection
