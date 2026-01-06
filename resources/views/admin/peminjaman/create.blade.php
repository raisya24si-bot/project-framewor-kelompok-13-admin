@extends('layouts.admin.app')

@section('title', 'Tambah Peminjaman')

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

            <li class="breadcrumb-item active">Tambah Peminjaman</li>
        </ol>
    </nav>

    <h3 class="font-weight-bold mt-3">Tambah Peminjaman Fasilitas</h3>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('admin.peminjaman.store') }}" method="POST">
            @csrf

            <div class="row">

                {{-- WARGA --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Warga</label>
                    <select name="warga_id" class="form-control" required>
                        <option value="">-- Pilih Warga --</option>
                        @foreach($warga as $w)
                            <option value="{{ $w->warga_id }}">
                                {{ $w->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- FASILITAS --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Fasilitas</label>
                    <select name="fasilitas_id" class="form-control" required>
                        <option value="">-- Pilih Fasilitas --</option>
                        @foreach($fasilitas as $f)
                            <option value="{{ $f->fasilitas_id }}">
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
                           required>
                </div>

                {{-- TANGGAL SELESAI --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Tanggal Selesai</label>
                    <input type="date"
                           name="tanggal_selesai"
                           class="form-control"
                           required>
                </div>

                {{-- TOTAL BIAYA --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Total Biaya (Rp)</label>
                    <input type="number"
                           name="total_biaya"
                           class="form-control"
                           min="0"
                           placeholder="Contoh: 500000"
                           required>
                    <small class="text-muted">
                        Biaya sewa fasilitas (dibayar di menu Pembayaran)
                    </small>
                </div>

                {{-- STATUS --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="pending">Pending</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                {{-- TUJUAN --}}
                <div class="col-md-12 mb-3">
                    <label class="font-weight-bold">Tujuan</label>
                    <textarea name="tujuan"
                              class="form-control"
                              rows="3"
                              placeholder="Contoh: Acara pernikahan, rapat warga, dll"
                              required></textarea>
                </div>

            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.peminjaman.index') }}"
                   class="btn btn-light mr-2">
                    Batal
                </a>
                <button class="btn btn-success">
                    <i class="ti-save"></i> Simpan
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
