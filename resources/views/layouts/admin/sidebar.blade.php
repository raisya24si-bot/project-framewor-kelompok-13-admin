<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    {{-- Dashboard --}}
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
         href="{{ route('admin.dashboard') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    {{-- Fasilitas --}}
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.fasilitas.*') ? 'active' : '' }}"
         href="{{ route('admin.fasilitas.index') }}">
        <i class="ti-home menu-icon"></i>
        <span class="menu-title">Fasilitas Umum</span>
      </a>
    </li>

    {{-- Syarat --}}
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.syarat.*') ? 'active' : '' }}"
         href="{{ route('admin.syarat.index') }}">
        <i class="ti-list menu-icon"></i>
        <span class="menu-title">Syarat Fasilitas</span>
      </a>
    </li>

    {{-- Petugas --}}
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}"
         href="{{ route('admin.petugas.index') }}">
        <i class="ti-user menu-icon"></i>
        <span class="menu-title">Petugas Fasilitas</span>
      </a>
    </li>

    {{-- Peminjaman --}}
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}"
         href="{{ route('admin.peminjaman.index') }}">
        <i class="ti-agenda menu-icon"></i>
        <span class="menu-title">Peminjaman Fasilitas</span>
      </a>
    </li>

    {{-- Pembayaran --}}
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}"
         href="{{ route('admin.pembayaran.index') }}">
        <i class="ti-credit-card menu-icon"></i>
        <span class="menu-title">Pembayaran</span>
      </a>
    </li>

    {{-- Media --}}
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}"
         href="{{ route('admin.media.index') }}">
        <i class="ti-image menu-icon"></i>
        <span class="menu-title">Media File</span>
      </a>
    </li>

    {{-- User --}}
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}"
         href="{{ route('admin.user.index') }}">
        <i class="ti-user menu-icon"></i>
        <span class="menu-title">Kelola User</span>
      </a>
    </li>

  </ul>
</nav>
