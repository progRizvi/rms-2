<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="@yield('meta_keywords')" />
    <meta name="description" content="@yield('meta_description')" />
    <meta name="author" content="@yield('author')" />
    <title>@yield('title')</title>
    <!-- Favicon-->
    <link rel="shortcut icon" href="https://www.chinabazarb2b.com/img/frontend/brand/favicon-32x32.png"
        type="image/x-icon" sizes="32x32">
    <link rel="icon" href="https://www.chinabazarb2b.com/img/frontend/brand/favicon-192x192.png" sizes="192x192">
    <link rel="apple-touch-icon" href="https://www.chinabazarb2b.com/img/frontend/brand/favicon-180x180.png">

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ url('/frontend/css/styles.css') }}" rel="stylesheet" />
    {{-- font awesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- Responsive navbar-->
    @include('frontend.fixed.nav')
    <!-- Page header with logo and tagline-->
    @include('frontend.fixed.header')
    <!-- Page content-->
    <div class="container">
        <div class="row">
            @yield('main')
            <!-- Side widgets-->
            @include('frontend.fixed.sidebar')
        </div>
        @stack('relatedPost')
    </div>
    <!-- Footer-->
    @include('frontend.fixed.footer')
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ url('frontend/js/scripts.js') }}"></script>
</body>

</html>
