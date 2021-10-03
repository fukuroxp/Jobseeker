<!DOCTYPE html>
<html lang="ID">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Unesa Career Center">
    <meta name="keywords" content="Unesa, Career, Center">
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UVCF | Unesa Virtual Career Fair</title>

    <!-- Google Font -->
    <link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/7/75/Unesa.png"/>
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <link href="{{ asset('template-landing/js/revolution-slider/css/settings.css') }}" rel="stylesheet">
    <link href="{{ asset('template-landing/css/owl.carousel.css') }}" rel="stylesheet">
    <!--<link href="{{ asset('template-landing/css/bootstrap.min.css') }}" rel="stylesheet">-->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('template-landing/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('template-landing/css/main.css') }}" rel="stylesheet">
    
    <!-- Css Styles -->
    <!--<link rel="stylesheet" href="{{ asset('fashi/css/bootstrap.min.css') }}" type="text/css">-->
    <!--<link rel="stylesheet" href="{{ asset('fashi/css/font-awesome.min.css') }}" type="text/css">-->
    <!--<link rel="stylesheet" href="{{ asset('fashi/css/themify-icons.css') }}" type="text/css">-->
    <!--<link rel="stylesheet" href="{{ asset('fashi/css/elegant-icons.css') }}" type="text/css">-->
    <!--<link rel="stylesheet" href="{{ asset('fashi/css/owl.carousel.min.css') }}" type="text/css">-->
    <!--<link rel="stylesheet" href="{{ asset('fashi/css/nice-select.css') }}" type="text/css">-->
    <!--<link rel="stylesheet" href="{{ asset('fashi/css/jquery-ui.min.css') }}" type="text/css">-->
    <!--<link rel="stylesheet" href="{{ asset('fashi/css/slicknav.min.css') }}" type="text/css">-->
    <!--<link rel="stylesheet" href="{{ asset('fashi/css/style.css') }}" type="text/css">-->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">-->
    <!--<link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />-->
    <!--<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>-->
    @yield('css')
</head>

<body id="google_translate_element">
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" integrity="sha512-DUC8yqWf7ez3JD1jszxCWSVB0DMP78eOyBpMa5aJki1bIRARykviOuImIczkxlj1KhVSyS16w2FSQetkD4UU2w==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"></script>
    <!--<script src="{{ asset('template-landing/js/bootstrap.min.js')}}"></script> -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('template-landing/js/revolution-slider/js/jquery.themepunch.tools.min.js')}}"></script> 
    <script type="text/javascript" src="{{ asset('template-landing/js/revolution-slider/js/jquery.themepunch.revolution.min.js')}}"></script> 
    <script src="{{ asset('template-landing/js/owl.carousel.js')}}"></script> 
    <script src="{{ asset('template-landing/js/script.js')}}"></script>
    
    <script type="text/javascript">
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'id', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
      }
    </script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
    
    <!-- Flag click handler -->
    <script type="text/javascript">
        $('.translation-links a').click(function() {
          var lang = $(this).data('lang');
          var $frame = $('.goog-te-menu-frame:first');
          if (!$frame.size()) {
            alert("Error: Could not find Google translate frame.");
            return false;
          }
          $frame.contents().find('.goog-te-menu2-item span.text:contains('+lang+')').get(0).click();
          return false;
        });
    </script>
    
    <!-- Js Plugins -->
    <!--<script src="{{ asset('fashi/js/jquery-3.3.1.min.js') }}"></script>-->
    <!--<script src="{{ asset('fashi/js/bootstrap.min.js') }}"></script>-->
    <!--<script src="{{ asset('fashi/js/jquery-ui.min.js') }}"></script>-->
    <!--<script src="{{ asset('fashi/js/jquery.countdown.min.js') }}"></script>-->
    <!--<script src="{{ asset('fashi/js/jquery.nice-select.min.js') }}"></script>-->
    <!--<script src="{{ asset('fashi/js/jquery.zoom.min.js') }}"></script>-->
    <!--<script src="{{ asset('fashi/js/jquery.dd.min.js') }}"></script>-->
    <!--<script src="{{ asset('fashi/js/jquery.slicknav.js') }}"></script>-->
    <!--<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>-->
    <!--<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>-->
    <!--<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>-->
    <!--<script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>-->
    <!--<script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>-->
    <!--<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>-->
    <!--<script src="{{ asset('app-assets/js/scripts/components.js') }}"></script>-->
    <!--<script src="{{ asset('fashi/js/owl.carousel.min.js') }}"></script>-->
    <!--<script src="{{ asset('fashi/js/main.js') }}"></script>-->
    @yield('js')
    
</body>

</html>