@extends('layouts.admin.app')

@section('title', 'Edit Pembayaran')

@section('content')

<div class="page-header py-4">
    <h3 class="font-weight-bold">Edit Pembayaran</h3>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('pembayaran.update', $data->bayar_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Peminjaman</label>
                <input type="text" class="form-control" readonly
                       value="{{ $data->peminjaman->warga->nama }} - {{ $data->peminjaman->fasilitas->nama }}">
            </div>

            <div class="form-group">
                <label>Tanggal Bayar</label>
                <input type="date" name="tanggal"
                       value="{{ $data->tanggal }}"
                       class="form-control" required>
            </div>

            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" name="jumlah"
                       value="{{ $data->jumlah }}"
                       class="form-control" required>
            </div>

            <div class="form-group">
                <label>Metode</label>
                <select name="metode" class="form-control">
                    <option value="Tunai" {{ $data->metode=='Tunai'?'selected':'' }}>Tunai</option>
                    <option value="Transfer" {{ $data->metode=='Transfer'?'selected':'' }}>Transfer</option>
                </select>
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3">
{{ $data->keterangan }}</textarea>
            </div>

            <div class="text-right">
                <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <button class="btn btn-primary">
                    Update
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
