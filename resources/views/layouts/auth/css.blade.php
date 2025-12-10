<!-- Ambil semua CSS dari admin -->
<link rel="stylesheet" href="{{ asset('fasilitas-admin/vendors/feather/feather.css') }}">
<link rel="stylesheet" href="{{ asset('fasilitas-admin/vendors/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('fasilitas-admin/vendors/css/vendor.bundle.base.css') }}">
<link rel="stylesheet" href="{{ asset('fasilitas-admin/css/vertical-layout-light/style.css') }}">

<!-- Custom CSS khusus halaman login -->
<style>
    body {
        background: #f4f5fa !important;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-card {
        width: 420px;
        background: #fff;
        border-radius: 18px;
        padding: 35px 40px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
