<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.auth.css') 
</head>

<body class="bg-light">

    <div class="container-scroller d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        @yield('content')
    </div>

    @include('layouts.admin.js')
</body>
</html>
