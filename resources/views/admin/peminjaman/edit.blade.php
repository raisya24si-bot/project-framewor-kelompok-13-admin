@extends('layouts.admin.app')

@section('title', 'Edit Peminjaman')

@section('content')

<div class="page-header py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom bg-transparent p-0 mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="icon-grid"></i>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.peminjaman.index') }}">Peminjaman</a>
            </li>
            <li class="breadcrumb-item active">Edit Peminjaman</li>
        </ol>
    </nav>

    <h3 class="font-weight-bold mt-3">Edit Data Peminjaman</h3>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('admin.peminjaman.update', $data->pinjam_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                {{-- WARGA --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Warga</label>
                    <select name="warga_id" class="form-control" required>
                        @foreach($warga as $w)
                            <option value="{{ $w->warga_id }}"
                                {{ $data->warga_id == $w->warga_id ? 'selected' : '' }}>
                                {{ $w->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- FASILITAS --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Fasilitas</label>
                    <select name="fasilitas_id" class="form-control" required>
                        @foreach($fasilitas as $f)
                            <option value="{{ $f->fasilitas_id }}"
                                {{ $data->fasilitas_id == $f->fasilitas_id ? 'selected' : '' }}>
                                {{ $f->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- TANGGAL MULAI --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Tanggal Mulai</label>
                    <input type="date"
                           name="tanggal_mulai"
                           class="form-control"
                           value="{{ $data->tanggal_mulai }}"
                           required>
                </div>

                {{-- TANGGAL SELESAI --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Tanggal Selesai</label>
                    <input type="date"
                           name="tanggal_selesai"
                           class="form-control"
                           value="{{ $data->tanggal_selesai }}"
                           required>
                </div>

                {{-- TOTAL BIAYA --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Total Biaya (Rp)</label>
                    <input type="number"
                           name="total_biaya"
                           class="form-control"
                           value="{{ $data->total_biaya ?? 0 }}"
                           min="0"
                           required>
                </div>

                {{-- STATUS --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="disetujui" {{ $data->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ $data->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="selesai" {{ $data->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                {{-- TUJUAN --}}
                <div class="col-md-12 mb-3">
                    <label class="font-weight-bold">Tujuan</label>
                    <textarea name="tujuan"
                              class="form-control"
                              rows="3"
                              required>{{ $data->tujuan }}</textarea>
                </div>

                {{-- INFO PEMBAYARAN (READ ONLY) --}}
                <div class="col-md-12 mb-3">
                    <label class="font-weight-bold">Status Pembayaran</label>

                    @if($data->pembayaran->count() > 0)
                        <div class="alert alert-info mb-0">
                            Sudah ada pembayaran
                            ({{ $data->pembayaran->count() }} transaksi)
                        </div>
                    @else
                        <div class="alert alert-warning mb-0">
                            Belum ada pembayaran
                        </div>
                    @endif
                </div>

            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-light mr-2">
                    Batal
                </a>
                <button class="btn btn-primary">
                    <i class="ti-save"></i> Update
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
