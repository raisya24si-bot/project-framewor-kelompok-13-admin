<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        
        <a href="{{ route('guest.dashboard') }}" class="navbar-brand p-0">
            <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Desa Digital</h1>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                
                <a href="{{ route('guest.dashboard') }}" class="nav-item nav-link {{ request()->routeIs('guest.dashboard') ? 'active' : '' }}">Beranda</a>
                
                <a href="{{ route('guest.fasilitas') }}" class="nav-item nav-link {{ request()->routeIs('guest.fasilitas') ? 'active' : '' }}">Fasilitas</a>
                
                <a href="{{ route('guest.peminjaman') }}" class="nav-item nav-link {{ request()->routeIs('guest.peminjaman') ? 'active' : '' }}">Peminjaman</a>
                
                <a href="{{ route('guest.pembayaran') }}" class="nav-item nav-link {{ request()->routeIs('guest.pembayaran') ? 'active' : '' }}">Pembayaran</a>
                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Info lain</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('guest.petugas') }}" class="dropdown-item">Petugas</a>
                        <a href="{{ route('guest.syarat') }}" class="dropdown-item">Syarat & Ketentuan</a>
                    </div>
                </div>

            </div>
        </div>
    </nav>
</div>