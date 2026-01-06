<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
         href="{{ route('dashboard') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('fasilitas.*') ? 'active' : '' }}"
         href="{{ route('fasilitas.index') }}">
        <i class="ti-home menu-icon"></i>
        <span class="menu-title">Fasilitas Umum</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('syarat.*') ? 'active' : '' }}"
         href="{{ route('syarat.index') }}">
        <i class="ti-list menu-icon"></i>
        <span class="menu-title">Syarat Fasilitas</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('petugas.*') ? 'active' : '' }}"
         href="{{ route('petugas.index') }}">
        <i class="ti-user menu-icon"></i>
        <span class="menu-title">Petugas Fasilitas</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}"
         href="{{ route('peminjaman.index') }}">
        <i class="ti-agenda menu-icon"></i>
        <span class="menu-title">Peminjaman Fasilitas</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('pembayaran.*') ? 'active' : '' }}"
         href="{{ route('pembayaran.index') }}">
        <i class="ti-credit-card menu-icon"></i>
        <span class="menu-title">Pembayaran</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('media.*') ? 'active' : '' }}"
         href="{{ route('media.index') }}">
        <i class="ti-image menu-icon"></i>
        <span class="menu-title">Media File</span>
      </a>
    </li>

   <li class="nav-item">
  <a class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}"
     href="{{ route('user.index') }}">
    <i class="ti-user menu-icon"></i>
    <span class="menu-title">Kelola User</span>
  </a>
</li>


  </ul>
</nav>
