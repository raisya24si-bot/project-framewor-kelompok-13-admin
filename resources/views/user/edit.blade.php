@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('content')

<div class="page-header py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom bg-transparent p-0 mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}"><i class="icon-grid"></i></a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('user.index') }}">Manajemen User</a>
            </li>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>
    </nav>

    <h3 class="font-weight-bold mt-3">Edit User</h3>
    <p class="text-muted">Ubah data user berikut sesuai kebutuhan</p>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('user.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                {{-- NAMA --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Nama</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $data->name) }}">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- EMAIL --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $data->email) }}">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Password Baru (Opsional)</label>
                    <input type="password" name="password" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti password.</small>
                </div>

                {{-- ROLE --}}
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold">Role</label>
                    <select name="role" class="form-control">
                        <option value="admin"   {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="petugas" {{ $data->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                        <option value="warga"   {{ $data->role == 'warga' ? 'selected' : '' }}>Warga</option>
                    </select>
                    @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

            </div>

            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('user.index') }}" class="btn btn-light mr-2">Batal</a>
                <button class="btn btn-primary">Update</button>
            </div>

        </form>

    </div>
</div>

@endsection
