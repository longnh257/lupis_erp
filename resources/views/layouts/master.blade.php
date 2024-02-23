<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="default" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/brand-logos/favicon.ico') }}" type="image/x-icon">

    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/authentication-main.js') }}"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/awesome-notifications/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}">

    <title>@yield('title', 'Trang Chủ')</title>
    <meta name="Description" content="@yield('description', '')">
    <meta name="Author" content="@yield('author', '')">
    <meta name="keywords" content="@yield('keywords', '')">
    <link rel="stylesheet" href="{{ asset('assets/libs/prismjs/themes/prism-coy.min.css') }}">
    <link href="{{ asset('assets/css/custome.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('includes.switcher')
    @include('includes.loader')
    <div class="page">
        @include('includes.header')
        @include('includes.sidebar')
        <div class="main-content app-content">
            @yield('content')
        </div>
        @include('includes.footer')
    </div>


    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="las la-angle-double-up"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Scroll To Top -->

    <!-- Popper JS -->
    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{ asset('assets/js/defaultmenu.min.js') }}"></script>

    <!-- Node Waves JS-->
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>


    <!-- Apex Charts JS -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- JSVector Maps JS -->
    <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>

    <!-- JSVector Maps MapsJS -->
    <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('assets/js/us-merc-en.js') }}"></script>

    <script src="{{ asset('assets/libs/awesome-notifications/index.var.js') }}"></script>
    <script src="{{ asset('vueJs/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vueJs/vue.min.js') }}"></script>
    <script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/sweet-alerts.js') }}"></script>
    @yield('script-footer')



</body>

</html>