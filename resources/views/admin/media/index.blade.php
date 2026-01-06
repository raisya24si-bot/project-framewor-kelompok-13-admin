@extends('layouts.admin.app')

@section('title', 'Media File')

@section('content')

<div class="page-header py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom bg-transparent p-0 mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="icon-grid"></i></a>
            </li>
            <li class="breadcrumb-item active">Media File</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            <h3 class="font-weight-bold mb-1">Data Media</h3>
            <p class="text-muted mb-0">Daftar file media (foto, dokumen, bukti).</p>
        </div>

        <a href="{{ route('admin.media.create') }}" class="btn btn-success">
            <i class="ti-plus"></i> Upload Media
        </a>
    </div>
</div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover text-center align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>Preview</th>
                        <th>Ref Table</th>
                        <th>Ref ID</th>
                        <th>Caption</th>
                        <th>Tipe File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($data as $item)
                    <tr>
                        {{-- PREVIEW --}}
                        <td>
                            <a href="{{ route('admin.media.show', $item->media_id) }}"
                               class="btn btn-outline-info btn-sm">
                                <i class="ti-eye"></i> Lihat
                            </a>
                        </td>

                        <td>{{ $item->ref_table }}</td>
                        <td>{{ $item->ref_id }}</td>
                        <td>{{ $item->caption ?? '-' }}</td>
                        <td>{{ $item->mime_type }}</td>

                        <td>
                            <form action="{{ route('admin.media.destroy', $item->media_id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus media ini?')">
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
                        <td colspan="6" class="text-muted py-4">
                            Belum ada data media.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-3 d-flex justify-content-center">
            {{ $data->links() }}
        </div>

    </div>
</div>

@endsection
