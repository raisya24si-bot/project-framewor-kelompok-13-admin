@extends('layouts.admin.app')

@section('title', 'Edit Pembayaran')

@section('content')

<div class="page-header py-4">
    <h3 class="font-weight-bold">Edit Pembayaran</h3>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('admin.pembayaran.update', $data->bayar_id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- PEMINJAMAN (READ ONLY) --}}
            <div class="form-group">
                <label class="font-weight-bold">Peminjaman</label>
                <input type="text"
                       class="form-control"
                       readonly
                       value="{{ $data->peminjaman->warga->nama }} - {{ $data->peminjaman->fasilitas->nama }}">
            </div>

            {{-- TANGGAL BAYAR --}}
            <div class="form-group">
                <label class="font-weight-bold">Tanggal Bayar</label>
                <input type="date"
                       name="tanggal"
                       value="{{ $data->tanggal }}"
                       class="form-control"
                       required>
            </div>

            {{-- JUMLAH --}}
            <div class="form-group">
                <label class="font-weight-bold">Jumlah Bayar</label>
                <input type="number"
                       name="jumlah"
                       value="{{ $data->jumlah }}"
                       class="form-control"
                       required>
            </div>

            {{-- METODE --}}
            <div class="form-group">
                <label class="font-weight-bold">Metode Pembayaran</label>
                <select name="metode"
                        class="form-control"
                        required>
                    <option value="Tunai" {{ $data->metode == 'Tunai' ? 'selected' : '' }}>
                        Tunai
                    </option>
                    <option value="Transfer" {{ $data->metode == 'Transfer' ? 'selected' : '' }}>
                        Transfer
                    </option>
                </select>
            </div>

            {{-- =====================
                 BUKTI PEMBAYARAN
            ====================== --}}
            <div class="form-group">
                <label class="font-weight-bold">Bukti Pembayaran</label>

                @php
                    $bukti = $data->media
                        ->where('caption', 'Bukti Pembayaran')
                        ->first();
                @endphp

                @if($bukti)
                    <div class="mb-2">
                      <a href="{{ url('admin/media/'.$bukti->id) }}"
                        target="_blank"
                         class="btn btn-sm btn-outline-primary">
                             <i class="ti-eye"></i> Lihat Bukti Lama
                      </a>
 
                    </div>
                @endif

                <input type="file"
                       name="bukti_pembayaran"
                       class="form-control"
                       accept="image/*,application/pdf">
                <small class="text-muted">
                    Kosongkan jika tidak ingin mengganti bukti
                </small>
            </div>

            {{-- =====================
                 RESI PEMBAYARAN
            ====================== --}}
            <div class="form-group">
                <label class="font-weight-bold">Resi Pembayaran</label>

                @php
                    $resi = $data->media
                        ->where('caption', 'Resi Pembayaran')
                        ->first();
                @endphp

                @if($resi)
                    <div class="mb-2">
                        <a href="{{ url('admin/media/'.$resi->id) }}"
                        target="_blank"
                    class="btn btn-sm btn-outline-success">
                    <i class="ti-receipt"></i> Lihat Resi Lama
                    </a>

                    </div>
                @endif

                <input type="file"
                       name="resi_pembayaran"
                       class="form-control"
                       accept="image/*,application/pdf">
                <small class="text-muted">
                    Opsional (boleh dikosongkan)
                </small>
            </div>

            {{-- KETERANGAN --}}
            <div class="form-group">
                <label class="font-weight-bold">Keterangan</label>
                <textarea name="keterangan"
                          class="form-control"
                          rows="3"
                          placeholder="Opsional">{{ $data->keterangan }}</textarea>
            </div>

            {{-- ACTION --}}
            <div class="text-right">
                <a href="{{ route('admin.pembayaran.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
                <button class="btn btn-primary">
                    <i class="ti-save"></i> Update Pembayaran
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
