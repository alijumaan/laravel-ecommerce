<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{  config('app.name') }}</title>

    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- all css here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/icofont.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">--}}

    <style>
        .score {
            display: block;
            font-size: 16px;
            position: relative;
            overflow: hidden;
        }
        .score-wrap {
            display: inline-block;
            position: relative;
            height: 19px;
        }
        .score .stars-active {
            color: #FFCA00;
            position: relative;
            z-index: 10;
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
        }
        .score .stars-inactive {
            color: lightgrey;
            position: absolute;
            top: 0;
            left: 0;
        }
        .rating {
            overflow: hidden;
            display: inline-block;
            position: relative;
            font-size: 20px;
        }
        .rating-star {
            padding: 0 5px;
            margin: 0;
            cursor: pointer;
            display: block;
            float: right;
        }
        .rating-star:after {
            position: relative;
            font-family: "Font Awesome 5 Free";
            content: '\f005';
            color: lightgrey;
        }
        .rating-star.checked ~ .rating-star:after,
        .rating-star.checked:after {
            content: '\f005';
            color: #FFCA00;
        }
        .rating:hover .rating-star:after {
            content: '\f005';
            color: lightgrey;
        }
        .rating-star:hover ~ .rating-star:after,
        .rating .rating-star:hover:after {
            content: '\f005';
            color: #FFCA00;
        }


    </style>

    @livewireStyles
    @yield('style')
</head>

<body>

    @include('frontend.layouts.header')

    <div class="text-center">
        @include('messages.flash')
    </div>
    @yield('content')

    @include('frontend.layouts.footer')

<!-- all js here -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/modernizr-2.8.3.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/jquery-1.12.0.min.js') }}"></script>
{{--<script src="{{ asset('frontend/js/popper.js') }}"></script>--}}
{{--<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>--}}
<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/js/ajax-mail.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/plugins.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>

<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/alert-message.js') }}"></script>
<script src="{{ url('https://kit.fontawesome.com/8003f9e0e2.js') }}" crossorigin="anonymous"></script>
@livewireScripts

@yield('script')
</body>
</html>
