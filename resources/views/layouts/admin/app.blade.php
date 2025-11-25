<!DOCTYPE html>
<html lang="en">
<head>
  @include('layouts.admin.css')
  @stack('styles')
</head>
<body>
  <div class="container-scroller">
    @include('layouts.admin.header')

    <div class="container-fluid page-body-wrapper">
      @include('layouts.admin.sidebar')

      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>

        @include('layouts.admin.footer')
      </div>
    </div>
  </div>

  @include('layouts.admin.js')
  @stack('scripts')
</body>
</html>
