@extends('layouts.admin.app')

@section('title', 'Fasilitas Umum')

@push('styles')
<style>
    .foto-thumb {
        width: 110px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        cursor: zoom-in;
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .foto-thumb:hover {
        transform: scale(1.15);
        box-shadow: 0 8px 20px rgba(0,0,0,.25);
    }

    /* MODAL */
    .foto-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: rgba(0,0,0,.8);
        align-items: center;
        justify-content: center;
    }

    .foto-modal.show {
        display: flex;
    }

    .foto-modal img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 10px;
        box-shadow: 0 10px 40px rgba(0,0,0,.4);
    }

    .foto-modal-close {
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 32px;
        color: #fff;
        cursor: pointer;
    }
</style>
@endpush

@section('content')

{{-- HEADER --}}
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
            <p class="text-muted mb-0">
                List fasilitas umum yang tersedia di lingkungan RT/RW.
            </p>
        </div>

        <a href="{{ route('fasilitas.create') }}" class="btn btn-success btn-icon-text">
            <i class="ti-plus btn-icon-prepend"></i> Tambah Fasilitas
        </a>
    </div>
</div>

{{-- FILTER --}}
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <form action="{{ route('fasilitas.index') }}" method="GET">
            <div class="form-row">
                <div class="col-md-4 mb-2">
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari fasilitas..."
                           value="{{ request('search') }}">
                </div>

                <div class="col-md-3 mb-2">
                    <select name="jenis" class="form-control">
                        <option value="">Semua Jenis</option>
                        @foreach (['Ruang','Aula','Lapangan','Gedung'] as $j)
                            <option value="{{ $j }}" {{ request('jenis')==$j?'selected':'' }}>
                                {{ $j }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 mb-2">
                    <button class="btn btn-primary btn-block">
                        <i class="ti-search"></i> Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ALERT --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show mt-2">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif

{{-- TABLE --}}
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover text-center align-middle">
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

                        {{-- FOTO --}}
                        <td>
                            @if ($item->foto())
                                <img src="{{ asset('storage/'.$item->foto()->file_url) }}"
                                     alt="Foto {{ $item->nama }}"
                                     class="foto-thumb"
                                     onclick="openFotoModal('{{ asset('storage/'.$item->foto()->file_url) }}')">
                            @else
                                <span class="badge badge-light text-muted">Tidak ada</span>
                            @endif
                        </td>

                        {{-- SOP --}}
                        <td>
                            @if ($item->sop())
                                <a href="{{ asset('storage/'.$item->sop()->file_url) }}"
                                   target="_blank"
                                   class="btn btn-outline-info btn-sm">
                                    <i class="ti-file"></i> SOP
                                </a>
                            @else
                                <span class="badge badge-light text-muted">Tidak ada</span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td>
                            <a href="{{ route('fasilitas.edit', $item->fasilitas_id) }}"
                               class="btn btn-primary btn-sm">
                                <i class="ti-pencil"></i>
                            </a>

                            <form action="{{ route('fasilitas.destroy', $item->fasilitas_id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="ti-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            Belum ada data fasilitas.
                        </td>
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

{{-- MODAL FOTO --}}
<div id="fotoModal" class="foto-modal" onclick="closeFotoModal()">
    <span class="foto-modal-close">&times;</span>
    <img id="fotoModalImg">
</div>

@endsection

@push('scripts')
<script>
    function openFotoModal(src) {
        document.getElementById('fotoModalImg').src = src;
        document.getElementById('fotoModal').classList.add('show');
    }

    function closeFotoModal() {
        document.getElementById('fotoModal').classList.remove('show');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeFotoModal();
        }
    });
</script>
@endpush
