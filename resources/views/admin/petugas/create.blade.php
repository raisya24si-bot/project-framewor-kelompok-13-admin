@extends('layouts.admin.app')

@section('title', 'Tambah Petugas Fasilitas')

@section('content')

    {{-- HEADER --}}
    <div class="page-header py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom bg-transparent p-0 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"><i class="icon-grid"></i></a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('petugas.index') }}">Petugas Fasilitas</a>
                </li>
                <li class="breadcrumb-item active">Tambah Petugas</li>
            </ol>
        </nav>

        <h3 class="font-weight-bold mt-3">Tambah Petugas Fasilitas</h3>
        <p class="text-muted mb-0">Isi data petugas dengan lengkap</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('petugas.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- FASILITAS --}}
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Fasilitas</label>
                        <select name="fasilitas_id" class="form-control @error('fasilitas_id') is-invalid @enderror">
                            <option value="">-- Pilih Fasilitas --</option>
                            @foreach ($fasilitas as $f)
                                <option value="{{ $f->fasilitas_id }}"
                                    {{ old('fasilitas_id') == $f->fasilitas_id ? 'selected' : '' }}>
                                    {{ $f->nama }}
                                </option>
                            @endforeach
                        </select>

                        @error('fasilitas_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- WARGA --}}
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Petugas (Warga)</label>
                        <select name="petugas_warga_id" class="form-control @error('petugas_warga_id') is-invalid @enderror">
                            <option value="">-- Pilih Warga --</option>
                            @foreach ($warga as $w)
                                <option value="{{ $w->warga_id }}"
                                    {{ old('petugas_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                    {{ $w->nama }}
                                </option>
                            @endforeach
                        </select>

                        @error('petugas_warga_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- PERAN --}}
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-bold">Peran</label>
                        <input type="text" name="peran" class="form-control @error('peran') is-invalid @enderror"
                               placeholder="Contoh: Penanggung Jawab"
                               value="{{ old('peran') }}">

                        @error('peran')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('petugas.index') }}" class="btn btn-light mr-2">Batal</a>
                    <button type="submit" class="btn btn-success">
                        <i class="ti-save mr-2"></i> Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>

@endsection
