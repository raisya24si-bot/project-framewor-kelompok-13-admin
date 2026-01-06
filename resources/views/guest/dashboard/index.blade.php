@extends('layouts.guest.app')

@section('content')

    {{-- CSS TAMBAHAN: Agar hover tidak zoom/aneh & Card tetap putih --}}
   {{-- CSS TAMBAHAN: MEMATIKAN EFEK BIRU & ZOOM --}}
    <style>
        /* 1. Mencegah Card berubah jadi Biru Solid saat di-hover */
        .blog-item:hover, .service-item:hover, .team-item:hover {
            background-color: #fff !important; /* Tetap Putih */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important; /* Tambah bayangan saja */
            transform: translateY(-5px); /* Efek naik sedikit */
        }

        /* 2. Mencegah Teks berubah jadi Putih (biar tetap terbaca) */
        .blog-item:hover h4, .service-item:hover h4, .team-item:hover h4,
        .blog-item:hover p, .service-item:hover p, .team-item:hover p,
        .blog-item:hover small, .service-item:hover small {
            color: #1a1a1a !important; /* Tetap Hitam/Gelap */
        }

        /* 3. Menjaga Warna Ikon Tetap Biru/Kuning/Hijau */
        .blog-item:hover i, .service-item:hover i {
            color: inherit !important; /* Ikuti warna aslinya */
        }

        /* 4. Mematikan efek zoom pada gambar */
        .blog-item:hover .blog-img img {
            transform: none !important;
            transition: none !important;
        }

        /* Ikon placeholder (Abu-abu) */
        .icon-placeholder {
            height: 200px;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }
    </style>

    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('fasilitas-guest/img/Pedesaan.jpg') }}" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 text-center">
                                    <h5 class="text-white text-uppercase mb-3 animated slideInDown">Selamat Datang</h5>
                                    <h1 class="display-1 text-white mb-5 animated slideInDown">Sistem Informasi Fasilitas Desa</h1>
                                    <a href="{{ route('guest.fasilitas') }}" class="btn btn-primary py-3 px-5 animated slideInDown">Lihat Fasilitas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="display-5 mb-4">Layanan Kami</h1>
                <p class="mb-0">Kemudahan akses fasilitas desa untuk seluruh warga.</p>
            </div>

            <div class="row g-4">
                
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-item bg-light rounded overflow-hidden shadow-sm h-100">
                        <div class="blog-img position-relative overflow-hidden">
                            <div class="icon-placeholder">
                                <i class="fa fa-calendar-check fa-4x"></i>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="mb-3">Booking Online</h4>
                            <p class="text-muted">Cek jadwal dan ajukan peminjaman fasilitas desa dari rumah.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="blog-item bg-light rounded overflow-hidden shadow-sm h-100">
                        <div class="blog-img position-relative overflow-hidden">
                            <div class="icon-placeholder">
                                <i class="fa fa-file-invoice-dollar fa-4x"></i>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="mb-3">Transparansi</h4>
                            <p class="text-muted">Biaya retribusi tercatat jelas dan masuk ke kas desa.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="blog-item bg-light rounded overflow-hidden shadow-sm h-100">
                        <div class="blog-img position-relative overflow-hidden">
                            <div class="icon-placeholder">
                                <i class="fa fa-broom fa-4x"></i>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="mb-3">Fasilitas Terawat</h4>
                            <p class="text-muted">Gedung dan alat dirawat berkala oleh petugas desa.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="blog-item bg-light rounded overflow-hidden shadow-sm h-100">
                        <div class="blog-img position-relative overflow-hidden">
                            <div class="icon-placeholder">
                                <i class="fa fa-users fa-4x"></i>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="mb-3">Untuk Warga</h4>
                            <p class="text-muted">Prioritas penggunaan untuk kegiatan sosial warga.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                        <div style="background-color: #eee; width: 100%; height: 400px; display: flex; align-items: center; justify-content: center; border-radius: 10px;">
                            <div class="text-center text-muted">
                                <i class="fa fa-image fa-3x mb-3"></i><br>
                                Foto Kegiatan Desa
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-5 mb-4">Efisiensi Pengelolaan Aset</h1>
                    <p class="mb-4">Sistem ini dibangun untuk memudahkan warga dalam memanfaatkan fasilitas umum. Tidak perlu lagi bolak-balik ke kantor desa.</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Peminjaman Gedung Serbaguna</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Penyewaan Tenda & Kursi</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Info Jadwal Realtime</p>
                    <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" href="{{ route('guest.syarat') }}">Baca Syarat</a>
                </div>
            </div>
        </div>
    </div>


    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="display-5 mb-4">Fasilitas Tersedia</h1>
                <p class="mb-0">Berikut adalah beberapa contoh fasilitas yang bisa dipinjam.</p>
            </div>
            
            <div class="row g-4">
                
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-item bg-light rounded overflow-hidden shadow-sm h-100">
                        <div class="blog-img position-relative overflow-hidden">
                           <img class="img-fluid w-100" src="{{ asset('fasilitas-guest/img/gedung2.png') }}" alt="Gedung Serbaguna">
                            <div class="position-absolute top-0 start-0 bg-primary text-white rounded-end py-2 px-4 mt-4">
                                <small>Indoor</small>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="mb-3">Gedung Serbaguna</h4>
                            <p class="text-muted">Cocok untuk rapat besar, resepsi pernikahan, dan musyawarah desa.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="blog-item bg-light rounded overflow-hidden shadow-sm h-100">
                        <div class="blog-img position-relative overflow-hidden">
                         <img class="img-fluid w-100" src="{{ asset('fasilitas-guest/img/LAPANGAN3.png') }}" alt="Lapangan Desa">
                            <div class="position-absolute top-0 start-0 bg-success text-white rounded-end py-2 px-4 mt-4">
                                <small>Outdoor</small>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="mb-3">Lapangan Desa</h4>
                            <p class="text-muted">Untuk kegiatan olahraga, upacara, atau acara outdoor lainnya.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="blog-item bg-light rounded overflow-hidden shadow-sm h-100">
                        <div class="blog-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('fasilitas-guest/img/TENDA-kursi2.png') }}" alt="Tenda Kursi">                            <div class="position-absolute top-0 start-0 bg-warning text-dark rounded-end py-2 px-4 mt-4">
                                <small>Peralatan</small>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="mb-3">Tenda & Kursi</h4>
                            <p class="text-muted">Penyewaan alat pesta untuk kebutuhan hajatan warga.</p>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="row mt-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-12 text-center">
                    <a class="btn btn-primary py-3 px-5" href="{{ route('guest.fasilitas') }}">Lihat Semua Fasilitas</a>
                </div>
            </div>

        </div>
    </div>

@endsection