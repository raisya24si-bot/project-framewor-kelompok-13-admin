@extends('layouts.admin.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-lg-8">

    <div class="card shadow-sm">
      <div class="card-header bg-white">
        <h4 class="mb-0">Profil Saya</h4>
        <small class="text-muted">Kelola informasi akun Anda</small>
      </div>

      <div class="card-body">
        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row">
            {{-- AVATAR --}}
            <div class="col-md-4 text-center mb-4">
              <img
                src="{{ $user->avatar
                      ? asset('storage/'.$user->avatar)
                      : asset('fasilitas-admin/images/faces/face28.jpg') }}"
                class="rounded-circle mb-3"
                style="width:120px;height:120px;object-fit:cover;"
              >

              <div class="form-group">
                <input type="file" name="avatar" class="form-control">
                <small class="text-muted">PNG / JPG, max 2MB</small>
              </div>
            </div>

            {{-- FORM --}}
            <div class="col-md-8">
              <div class="form-group mb-3">
                <label class="font-weight-bold">Nama</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $user->name) }}">
              </div>

              <div class="form-group mb-3">
                <label class="font-weight-bold">Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email', $user->email) }}">
              </div>

              <div class="form-group mb-3">
                <label class="font-weight-bold">
                  Password Baru <span class="text-muted">(Opsional)</span>
                </label>
                <input type="password" name="password" class="form-control">
              </div>

              <div class="form-group mb-4">
                <label class="font-weight-bold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control">
              </div>
            </div>
          </div>

          <div class="text-right">
            <button class="btn btn-primary px-4">
              <i class="ti-save mr-1"></i> Update Profil
            </button>
          </div>

        </form>
      </div>
    </div>

  </div>
</div>
@endsection
