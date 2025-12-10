@extends('layouts.auth.app')

@section('title', 'Login')

@section('content')

<style>
    .login-card {
        width: 420px;
        background: white;
        border-radius: 18px;
        padding: 35px 40px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        animation: fadeIn 0.4s ease;
    }

    h3 {
        font-weight: 700;
        color: #333;
        margin-bottom: 25px;
        text-align: center;
    }

    label {
        font-weight: 600;
        color: #555;
        font-size: 0.9rem;
    }

    .form-control {
        border-radius: 10px;
        height: 45px;
        border: 1px solid #d8d8d8;
    }

    .btn-login {
        background: #6f42c1;
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px;
        width: 100%;
        border-radius: 12px;
        margin-top: 10px;
        transition: 0.3s;
    }

    .btn-login:hover {
        background: #5a31a8;
        box-shadow: 0 4px 12px rgba(111, 66, 193, 0.3);
        transform: translateY(-2px);
    }

    .alert-custom {
        border-radius: 12px;
        font-size: 0.9rem;
        padding: 12px;
        text-align: center;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="login-card">

    <h3>Login</h3>

    {{-- Error alert --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-custom">
            Email atau password salah!
        </div>
    @endif

    <form action="{{ route('auth.login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input
                type="email"
                name="email"
                class="form-control"
                placeholder="Masukkan email"
                required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Masukkan password"
                required>
        </div>

        <button class="btn btn-login">Login</button>
    </form>

</div>

@endsection
