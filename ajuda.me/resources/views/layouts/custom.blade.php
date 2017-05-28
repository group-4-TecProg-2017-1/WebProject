<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <!-- Grid Component css -->
    <link rel="stylesheet" href="{{ asset('css/component.css') }}">
    <!-- Slit Slider css -->
    <link rel="stylesheet" href="{{ asset('css/slit-slider.css') }}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <!-- Media Queries -->
    <link rel="stylesheet" href="{{ asset('css/media-queries.css') }}">
    <!-- Login.css -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        @include ('layouts.nav')

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/modernizr-2.6.2.min.js') }}"></script>

    <!-- Main jQuery -->
        <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
        <!-- Slitslider -->
        <script src="{{ asset('js/jquery.slitslider.js') }}"></script>
        <script src="{{ asset('js/jquery.ba-cond.min.js') }}"></script>
        <!-- Parallax -->
        <script src="{{ asset('js/jquery.parallax-1.1.3.js') }}"></script>
        <!-- Owl Carousel -->
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <!-- Portfolio Filtering -->
        <script src="{{ asset('js/jquery.mixitup.min.js') }}"></script>
        <!-- Custom Scrollbar -->
        <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
        <!-- Jappear js -->
        <script src="{{ asset('js/jquery.appear.js') }}"></script>
        <!-- Pie Chart -->
        <script src="{{ asset('js/easyPieChart.js') }}"></script>
        <!-- jQuery Easing -->
        <script src="{{ asset('js/jquery.easing-1.3.pack.js') }}"></script>
        <!-- tweetie.min -->
        <script src="{{ asset('js/tweetie.min.js') }}"></script>
        <!-- Google Map API -->
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <!-- Highlight menu item -->
        <script src="{{ asset('js/jquery.nav.js') }}"></script>
        <!-- Sticky Nav -->
        <script src="{{ asset('js/jquery.sticky.js') }}"></script>
        <!-- Number Counter Script -->
        <script src="{{ asset('js/jquery.countTo.js') }}"></script>
        <!-- wow.min Script -->
        <script src="{{ asset('js/wow.min.js') }}"></script>
        <!-- For video responsive -->
        <script src="{{ asset('js/jquery.fitvids.js') }}"></script>

        <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
