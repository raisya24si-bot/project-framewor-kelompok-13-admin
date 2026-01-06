@extends('layouts.admin.app')

@section('title', 'Tambah Pembayaran')

@section('content')

<div class="page-header py-4">
    <h3 class="font-weight-bold">Tambah Pembayaran</h3>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('admin.pembayaran.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            {{-- PEMINJAMAN --}}
            <div class="form-group">
                <label class="font-weight-bold">Peminjaman</label>
                <select name="pinjam_id"
                        id="pinjam_id"
                        class="form-control"
                        required>
                    <option value="">-- Pilih Peminjaman --</option>
                    @foreach ($peminjaman as $item)
                        <option value="{{ $item->pinjam_id }}"
                                data-total="{{ $item->total_biaya }}">
                            {{ $item->warga->nama }} -
                            {{ $item->fasilitas->nama }}
                            (Rp {{ number_format($item->total_biaya,0,',','.') }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TANGGAL BAYAR --}}
            <div class="form-group">
                <label class="font-weight-bold">Tanggal Bayar</label>
                <input type="date"
                       name="tanggal"
                       class="form-control"
                       required>
            </div>

            {{-- JUMLAH --}}
            <div class="form-group">
                <label class="font-weight-bold">Jumlah Bayar</label>
                <input type="number"
                       name="jumlah"
                       id="jumlah"
                       class="form-control"
                       readonly
                       required>
                <small class="text-muted">
                    Otomatis mengikuti total biaya peminjaman
                </small>
            </div>

            {{-- METODE --}}
            <div class="form-group">
                <label class="font-weight-bold">Metode Pembayaran</label>
                <select name="metode"
                        class="form-control"
                        required>
                    <option value="Tunai">Tunai</option>
                    <option value="Transfer">Transfer</option>
                </select>
            </div>

            {{-- BUKTI PEMBAYARAN --}}
            <div class="form-group">
                <label class="font-weight-bold">Bukti Pembayaran</label>
                <input type="file"
                       name="bukti_pembayaran"
                       class="form-control"
                       accept="image/*,application/pdf"
                       required>
                <small class="text-muted">
                    Upload foto / PDF bukti pembayaran
                </small>
            </div>

            {{-- RESI --}}
            <div class="form-group">
                <label class="font-weight-bold">Resi Pembayaran</label>
                <input type="file"
                       name="resi_pembayaran"
                       class="form-control"
                       accept="image/*,application/pdf">
                <small class="text-muted">
                    Opsional (misal: resi transfer)
                </small>
            </div>

            {{-- KETERANGAN --}}
            <div class="form-group">
                <label class="font-weight-bold">Keterangan</label>
                <textarea name="keterangan"
                          class="form-control"
                          rows="3"
                          placeholder="Opsional"></textarea>
            </div>

            <div class="text-right">
                <a href="{{ route('admin.pembayaran.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
                <button class="btn btn-success">
                    <i class="ti-save"></i> Simpan Pembayaran
                </button>
            </div>

        </form>

    </div>
</div>

{{-- AUTO ISI JUMLAH --}}
<script>
    document.getElementById('pinjam_id').addEventListener('change', function () {
        const total = this.options[this.selectedIndex].dataset.total;
        document.getElementById('jumlah').value = total ?? '';
    });
</script>

@endsection
