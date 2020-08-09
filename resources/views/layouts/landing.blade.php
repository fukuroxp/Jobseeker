<!DOCTYPE html>
<html lang="ID">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Dharma Wanita Persatuan">
    <meta name="keywords" content="Dharma, Wanita, Persatuan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dharma Wanita Persatuan</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('fashi/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fashi/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fashi/css/themify-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fashi/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fashi/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fashi/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fashi/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fashi/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fashi/css/style.css') }}" type="text/css">
    @yield('css')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    @include('layouts.partials.landing.header')
    <!-- Header End -->

    @yield('content')

    <!-- Footer Section Begin -->
    @include('layouts.partials.landing.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('fashi/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('fashi/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('fashi/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('fashi/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('fashi/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('fashi/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('fashi/js/jquery.dd.min.js') }}"></script>
    <script src="{{ asset('fashi/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('fashi/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('fashi/js/main.js') }}"></script>
    @yield('js')
</body>

</html>