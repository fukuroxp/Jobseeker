<!DOCTYPE html>
<html lang="ID">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Unesa Career Center">
    <meta name="keywords" content="Unesa, Career, Center">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Unesa Virtual Career Fair</title>

    <!-- Google Font -->
    <link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/7/75/Unesa.png"/>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
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
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/components.js') }}"></script>
    <script src="{{ asset('fashi/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('fashi/js/main.js') }}"></script>
    @yield('js')
</body>

</html>