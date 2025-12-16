{{-- Navbar + settings panel --}}
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">

    {{-- LOGO BESAR --}}
    <a class="navbar-brand brand-logo mr-5 d-flex align-items-center" href="{{ route('dashboard') }}">
      <img src="{{ asset('assets/logo/key.png') }}"
           alt="FasPin"
           style="height: 40px;">
    </a>

  </div>

  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>

    {{-- SEARCH --}}
    <ul class="navbar-nav mr-lg-2">
      <li class="nav-item nav-search d-none d-lg-block">
        <div class="input-group">
          <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
            <span class="input-group-text">
              <i class="icon-search"></i>
            </span>
          </div>
          <input type="text" class="form-control" placeholder="Cari fasilitas...">
        </div>
      </li>
    </ul>

    {{-- RIGHT MENU --}}
    <ul class="navbar-nav navbar-nav-right">

      {{-- NOTIFICATION --}}
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
          <i class="icon-bell mx-0"></i>
          <span class="count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list">
          <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-success">
                <i class="ti-info-alt mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">System Ready</h6>
              <p class="font-weight-light small-text mb-0 text-muted">Just now</p>
            </div>
          </a>
        </div>
      </li>

      {{-- PROFILE --}}
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-toggle="dropdown">

          <img src="{{ Auth::user()->avatar
              ? asset('storage/' . Auth::user()->avatar)
              : asset('fasilitas-admin/images/faces/face28.jpg') }}"
               alt="profile"
               class="rounded-circle"
               style="width:35px;height:35px;object-fit:cover;">

          <span class="ml-2 font-weight-bold text-dark">
            {{ Auth::user()->name ?? 'User' }}
          </span>
        </a>

        <div class="dropdown-menu dropdown-menu-right navbar-dropdown">
          <a class="dropdown-item">
            <i class="ti-user text-primary"></i> Profil Saya
          </a>

          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="dropdown-item" type="submit">
              <i class="ti-power-off text-primary"></i> Logout
            </button>
          </form>
        </div>
      </li>

      <li class="nav-item nav-settings d-none d-lg-flex">
        <a class="nav-link"><i class="icon-ellipsis"></i></a>
      </li>

    </ul>

    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
