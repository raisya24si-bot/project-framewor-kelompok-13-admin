@extends('layouts.admin.app')

@section('title', 'Tambah Pembayaran')

@section('content')

<div class="page-header py-4">
    <h3 class="font-weight-bold">Tambah Pembayaran</h3>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('pembayaran.store') }}" method="POST">
            @csrf

            {{-- Peminjaman --}}
            <div class="form-group">
                <label>Peminjaman</label>
                <select name="pinjam_id" class="form-control" required>
                    <option value="">-- Pilih Peminjaman --</option>
                    @foreach ($peminjaman as $item)
                        <option value="{{ $item->pinjam_id }}">
                            {{ $item->warga->nama }} - {{ $item->fasilitas->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tanggal --}}
            <div class="form-group">
                <label>Tanggal Bayar</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            {{-- Jumlah --}}
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" required>
            </div>

            {{-- Metode --}}
            <div class="form-group">
                <label>Metode Pembayaran</label>
                <select name="metode" class="form-control" required>
                    <option value="Tunai">Tunai</option>
                    <option value="Transfer">Transfer</option>
                </select>
            </div>

            {{-- Keterangan --}}
            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3"></textarea>
            </div>

            <div class="text-right">
                <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <button class="btn btn-success">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
