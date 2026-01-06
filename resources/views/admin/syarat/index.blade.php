
@extends('layouts.admin.app')

@section('title', 'Syarat Fasilitas')

@section('content')

    {{-- HEADER --}}
    <div class="page-header py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom bg-transparent p-0 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-grid"></i></a>
                </li>
                <li class="breadcrumb-item active">Syarat Fasilitas</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <h3 class="font-weight-bold mb-1">Data Syarat Fasilitas</h3>
                <p class="text-muted mb-0">List syarat yang berlaku untuk fasilitas umum</p>
            </div>

            {{-- FIXED: route syarat.create --}}
            <a href="{{ route('admin.syarat.create') }}" class="btn btn-success btn-icon-text">
                <i class="ti-plus btn-icon-prepend"></i> Tambah Syarat
            </a>
        </div>
    </div>

    {{-- FILTER --}}
    <div id="filter-syarat" class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            
            {{-- FIXED: route syarat.index --}}
            <form action="{{ route('admin.syarat.index') }}" method="GET">
                <div class="form-row">

                    {{-- Search --}}
                    <div class="col-md-4 mb-2">
                        <input type="text" name="search" class="form-control"
                               placeholder="Cari nama fasilitas..."
                               value="{{ request('search') }}">
                    </div>

                    {{-- Per Page --}}
                    <div class="col-md-3 mb-2">
                        <select name="per_page" class="form-control">
                            @foreach([10, 25, 50, 100] as $num)
                                <option value="{{ $num }}" 
                                    {{ request('per_page') == $num ? 'selected' : '' }}>
                                    {{ $num }} data
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tombol --}}
                    <div class="col-md-2 mb-2">
                        <button class="btn btn-primary btn-block">
                            <i class="ti-search"></i> Cari
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- FLASH MESSAGE --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
            <i class="ti-check mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        </div>
    @endif
    
    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover text-center align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Fasilitas</th>
                            <th>Nama Syarat</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="font-weight-bold">
                                    {{ $item->fasilitas->nama ?? '-' }}
                                </td>
                                <td>{{ $item->nama_syarat }}</td>
                                <td>{{ $item->deskripsi ?? '-' }}</td>

                                <td>
                                    {{-- FIXED: route syarat.edit --}}
                                    <a href="{{ route('admin.syarat.edit', $item->syarat_id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="ti-pencil"></i> Edit
                                    </a>

                                    {{-- FIXED: destroy tetap syarat.destroy --}}
                                    <form action="{{ route('admin.syarat.destroy', $item->syarat_id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            <i class="ti-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="text-muted py-4">Belum ada data syarat.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

                {{-- PAGINATION --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $data->links() }}
                </div>

            </div>
        </div>
    </div>

@endsection
