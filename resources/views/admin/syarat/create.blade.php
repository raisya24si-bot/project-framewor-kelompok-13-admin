@extends('layouts.admin.app')

@section('title', 'Tambah Syarat Fasilitas')

@section('content')

    {{-- HEADER --}}
    <div class="page-header py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom bg-transparent p-0 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-grid"></i></a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.syarat.index') }}">Syarat Fasilitas</a>
                </li>
                <li class="breadcrumb-item active">Tambah Syarat</li>
            </ol>
        </nav>

        <h3 class="font-weight-bold mt-3">Tambah Syarat Fasilitas</h3>
        <p class="text-muted mb-0">Lengkapi data syarat fasilitas dengan benar</p>
    </div>

    {{-- FORM CARD --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('admin.syarat.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- FASILITAS --}}
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-bold">Pilih Fasilitas</label>
                        <select name="fasilitas_id"
                                class="form-control @error('fasilitas_id') is-invalid @enderror">
                            <option value="">-- Pilih Fasilitas --</option>

                            @foreach($fasilitas as $item)
                                <option value="{{ $item->fasilitas_id }}"
                                    {{ old('fasilitas_id') == $item->fasilitas_id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach

                        </select>

                        @error('fasilitas_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- NAMA SYARAT --}}
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-bold">Nama Syarat</label>
                        <input type="text" name="nama_syarat"
                               class="form-control @error('nama_syarat') is-invalid @enderror"
                               value="{{ old('nama_syarat') }}"
                               placeholder="Contoh: Membawa KTP">

                        @error('nama_syarat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-bold">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Tambahkan penjelasan syarat...">{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('admin.syarat.index') }}" class="btn btn-light mr-2">Batal</a>
                    <button type="submit" class="btn btn-success">
                        <i class="ti-save mr-2"></i> Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection
