@extends('layouts.admin.app')

@section('title', 'Upload Media')

@section('content')

<div class="page-header py-4">
    <h3 class="font-weight-bold">Upload Media</h3>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- REF TABLE --}}
            <div class="form-group">
                <label>Ref Table</label>
                <select name="ref_table" class="form-control" required>
                    <option value="">-- Pilih Modul --</option>
                    <option value="fasilitas_umum">Fasilitas Umum</option>
                    <option value="peminjaman_fasilitas">Peminjaman Fasilitas</option>
                    <option value="syarat_fasilitas">Syarat Fasilitas</option>
                </select>
            </div>

            {{-- REF ID --}}
            <div class="form-group">
                <label>Ref ID</label>
                <input type="number" name="ref_id" class="form-control"
                       placeholder="ID data terkait" required>
            </div>

            {{-- FILE --}}
            <div class="form-group">
                <label>File</label>
                <input type="file" name="file_url" class="form-control-file" required>
                <small class="text-muted">Format: jpg, png, pdf (max 2MB)</small>
            </div>

            {{-- CAPTION --}}
            <div class="form-group">
                <label>Caption</label>
                <textarea name="caption" class="form-control" rows="3"
                          placeholder="Keterangan file (opsional)"></textarea>
            </div>

            <div class="text-right">
                <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">
                    Batal
                </a>
                <button class="btn btn-success">
                    Upload
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
