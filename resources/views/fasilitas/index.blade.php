@extends('layouts.admin.app')

@section('title', 'Fasilitas Umum')

@section('content')

    {{-- ===========================
         HEADER (SAMA PERSIS DGN SYARAT)
    ============================ --}}
    <div class="page-header py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom bg-transparent p-0 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"><i class="icon-grid"></i></a>
                </li>
                <li class="breadcrumb-item active">Fasilitas Umum</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <h3 class="font-weight-bold mb-1">Data Fasilitas Umum</h3>
                <p class="text-muted mb-0">List fasilitas umum yang tersedia di lingkungan RT/RW.</p>
            </div>

            <a href="{{ route('fasilitas.create') }}" class="btn btn-success btn-icon-text">
                <i class="ti-plus btn-icon-prepend"></i> Tambah Fasilitas
            </a>
        </div>
    </div>

    {{-- ===========================
         FILTER CARD
    ============================ --}}
    <div id="filter-fasilitas" class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('fasilitas.index') }}" method="GET">
                <div class="form-row">

                    {{-- Search --}}
                    <div class="col-md-4 mb-2">
                        <input type="text" name="search" class="form-control"
                               placeholder="Cari fasilitas..."
                               value="{{ request('search') }}">
                    </div>

                    {{-- Filter Jenis --}}
                    <div class="col-md-3 mb-2">
                        <select name="jenis" class="form-control">
                            <option value="">Semua Jenis</option>
                            <option value="Ruang" {{ request('jenis')=='Ruang' ? 'selected' : '' }}>Ruang</option>
                            <option value="Aula" {{ request('jenis')=='Aula' ? 'selected' : '' }}>Aula</option>
                            <option value="Lapangan" {{ request('jenis')=='Lapangan' ? 'selected' : '' }}>Lapangan</option>
                            <option value="Gedung" {{ request('jenis')=='Gedung' ? 'selected' : '' }}>Gedung</option>
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

    {{-- ===========================
         TABLE
    ============================ --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table id="fasilitas-table" class="table table-hover text-center align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Alamat</th>
                            <th>RT</th>
                            <th>RW</th>
                            <th>Kapasitas</th>
                            <th>Foto</th>
                            <th>SOP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="font-weight-bold">{{ $item->nama }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->rt }}</td>
                                <td>{{ $item->rw }}</td>
                                <td>{{ $item->kapasitas }}</td>

                                {{-- Foto --}}
                                <td>
                                    @if ($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                             width="60" class="rounded shadow-sm">
                                    @else
                                        <span class="badge badge-light text-muted">Tidak ada</span>
                                    @endif
                                </td>

                                {{-- SOP --}}
                                <td>
                                    @if ($item->sop)
                                        <a href="{{ asset('storage/' . $item->sop) }}" target="_blank"
                                           class="btn btn-outline-info btn-sm">
                                            <i class="ti-file"></i> SOP
                                        </a>
                                    @else
                                        <span class="badge badge-light text-muted">Tidak ada</span>
                                    @endif
                                </td>

                                {{-- ACTION --}}
                                <td>
                                    <a href="{{ route('fasilitas.edit', $item->fasilitas_id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="ti-pencil"></i> Edit
                                    </a>

                                    <form action="{{ route('fasilitas.destroy', $item->fasilitas_id) }}"
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
                                <td colspan="9" class="text-muted py-4">Belum ada data fasilitas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $data->links() }}
            </div>

        </div>
    </div>

@endsection
