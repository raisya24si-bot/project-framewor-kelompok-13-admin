<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Sistem Informasi Desa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    {{-- CSS Libraries --}}
    <link href="{{ asset('fasilitas-guest/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fasilitas-guest/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fasilitas-guest/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fasilitas-guest/css/style.css') }}" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- ========================================================= --}}
    {{-- CSS GLOBAL "ANTI-BIRU" (Fix Layar Tertutup) --}}
    {{-- ========================================================= --}}
    <style>
        /* 1. Matikan efek Overlay/Lapisan Biru yang mungkin muncul */
        .service-item::before, .service-item::after,
        .blog-item::before, .blog-item::after,
        .team-item::before, .team-item::after {
            background: transparent !important;
            display: none !important;
            opacity: 0 !important;
        }

        /* 2. Paksa Latar Belakang Tetap PUTIH saat Hover */
        .service-item:hover, 
        .blog-item:hover, 
        .team-item:hover {
            background-color: #ffffff !important; 
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
            transform: translateY(-5px); /* Tetap ada efek naik sedikit */
        }

        /* 3. Kunci Warna Teks Judul (H4) jadi HITAM */
        .service-item:hover h4, 
        .blog-item:hover h4, 
        .team-item:hover h4 {
            color: #000000 !important;
        }

        /* 4. Kunci Warna Deskripsi (P) jadi ABU-ABU */
        .service-item:hover p, 
        .blog-item:hover p, 
        .team-item:hover p,
        .service-item:hover .text-muted,
        .blog-item:hover .text-muted {
            color: #6c757d !important;
        }

        /* 5. Kunci Warna Ikon & Teks Kecil jadi BIRU (Primary) */
        .service-item:hover i, 
        .blog-item:hover i, 
        .team-item:hover i,
        .service-item:hover small,
        .service-item:hover small i {
            color: #0d6efd !important;
        }

        /* 6. Matikan Efek Zoom pada Gambar (Jika ada) */
        .blog-item:hover .blog-img img {
            transform: none !important;
        }
    </style>
</head>

<body>
    {{-- Loading Spinner --}}
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    {{-- Navbar --}}
    @include('layouts.guest.navbar')

    {{-- Content --}}
    <div class="position-relative">
        @yield('content')
    </div>

    {{-- Footer --}}
    @include('layouts.guest.footer')

    {{-- Back to Top --}}
    <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

    {{-- Javascript --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('fasilitas-guest/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('fasilitas-guest/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('fasilitas-guest/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('fasilitas-guest/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('fasilitas-guest/js/main.js') }}"></script>
</body>
</html>