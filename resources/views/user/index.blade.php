@extends('layouts.admin.app')

@section('title', 'Data User')

@section('content')

<div class="page-header py-4 d-flex justify-content-between align-items-center">
    <div>
        <h3 class="font-weight-bold mb-2">Manajemen User</h3>
        <p class="text-muted">Kelola akun yang bisa mengakses sistem.</p>
    </div>

    <a href="{{ route('user.create') }}" class="btn btn-success btn-icon-text">
        <i class="ti-plus btn-icon-prepend"></i> Tambah User
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead class="thead-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge badge-info">{{ ucfirst($user->role) }}</span></td>

                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm">
                                    <i class="ti-pencil"></i>
                                </a>

                                <form action="{{ route('user.destroy', $user->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
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
                            <td colspan="4" class="text-muted py-4">Belum ada user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $data->links() }}
        </div>

    </div>
</div>

@endsection
