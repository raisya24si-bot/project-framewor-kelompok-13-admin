@extends('layouts.admin.app')

@section('title', 'Petugas Fasilitas')

@section('content')

    {{-- HEADER --}}
    <div class="page-header py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom bg-transparent p-0 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"><i class="icon-grid"></i></a>
                </li>
                <li class="breadcrumb-item active">Petugas Fasilitas</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <h3 class="font-weight-bold mb-1">Data Petugas Fasilitas</h3>
                <p class="text-muted mb-0">List petugas yang bertanggung jawab terhadap fasilitas.</p>
            </div>

            <a href="{{ route('petugas.create') }}" class="btn btn-success btn-icon-text">
                <i class="ti-plus btn-icon-prepend"></i> Tambah Petugas
            </a>
        </div>
    </div>
     @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover text-center align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>Fasilitas</th>
                            <th>Nama Petugas</th>
                            <th>Peran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="font-weight-bold">{{ $item->fasilitas->nama }}</td>
                                <td>{{ $item->warga->nama }}</td>
                                <td>{{ $item->peran }}</td>

                                <td>
                                    <a href="{{ route('petugas.edit', $item->petugas_id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="ti-pencil"></i> Edit
                                    </a>

                                    <form action="{{ route('petugas.destroy', $item->petugas_id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus petugas ini?')">
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
                                <td colspan="4" class="text-muted py-4">Belum ada petugas yang ditambahkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $data->links() }}
            </div>

        </div>
    </div>

@endsection
