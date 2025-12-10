@extends('layouts.admin.app')

@section('title', 'Tambah Fasilitas Umum')

@section('content')

    {{-- HEADER + BREADCRUMB --}}
    <div class="page-header py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom bg-transparent p-0 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"><i class="icon-grid"></i></a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('fasilitas.index') }}">Fasilitas Umum</a>
                </li>
                <li class="breadcrumb-item active">Tambah Fasilitas</li>
            </ol>
        </nav>

        <h3 class="font-weight-bold mt-3">Tambah Fasilitas Umum</h3>
        <p class="text-muted mb-0">Isi data fasilitas dengan lengkap.</p>
    </div>

    {{-- FORM CARD --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    {{-- NAMA FASILITAS --}}
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Nama Fasilitas</label>
                        <input type="text" name="nama"
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}" placeholder="Contoh: Aula Desa">
                        @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- JENIS --}}
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Jenis</label>
                        <select name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Aula" {{ old('jenis') == 'Aula' ? 'selected' : '' }}>Aula</option>
                            <option value="Lapangan" {{ old('jenis') == 'Lapangan' ? 'selected' : '' }}>Lapangan</option>
                            <option value="Gedung" {{ old('jenis') == 'Gedung' ? 'selected' : '' }}>Gedung</option>
                            <option value="Ruang" {{ old('jenis') == 'Ruang' ? 'selected' : '' }}>Ruang</option>
                            <option value="Lainnya" {{ old('jenis') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('jenis') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- ALAMAT --}}
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-bold">Alamat</label>
                        <input type="text" name="alamat"
                               class="form-control @error('alamat') is-invalid @enderror"
                               value="{{ old('alamat') }}" placeholder="Contoh: Jl. Merdeka No.12">
                        @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- RT --}}
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">RT</label>
                        <select name="rt" class="form-control @error('rt') is-invalid @enderror">
                            <option value="">-- RT --</option>
                            @for ($i = 1; $i <= 9; $i++)
                                <option value="{{ $i }}" {{ old('rt') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('rt') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- RW --}}
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">RW</label>
                        <select name="rw" class="form-control @error('rw') is-invalid @enderror">
                            <option value="">-- RW --</option>
                            @for ($i = 1; $i <= 9; $i++)
                                <option value="{{ $i }}" {{ old('rw') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('rw') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- KAPASITAS --}}
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Kapasitas (orang)</label>
                        <input type="number" name="kapasitas"
                               class="form-control @error('kapasitas') is-invalid @enderror"
                               value="{{ old('kapasitas') }}" placeholder="Contoh: 50">
                        @error('kapasitas') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-bold">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Tambahkan keterangan fasilitas...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- FOTO --}}
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Foto Fasilitas</label>
                        <input type="file" name="foto"
                               class="form-control-file @error('foto') is-invalid @enderror">
                        @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- SOP --}}
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">File SOP (PDF)</label>
                        <input type="file" name="sop"
                               class="form-control-file @error('sop') is-invalid @enderror">
                        @error('sop') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('fasilitas.index') }}" class="btn btn-light mr-2">Batal</a>
                    <button type="submit" class="btn btn-success">
                        <i class="ti-save mr-2"></i> Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection
