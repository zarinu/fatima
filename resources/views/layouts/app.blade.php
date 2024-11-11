<!DOCTYPE html>
<html lang="fa" dir="rtl" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="//script.crazyegg.com/pages/scripts/0127/1079.js" async="async"></script>
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="icon" href="favicon.png">
    @stack('styles')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>آموزش عروسک سازی حیدری | @yield('title')</title>
</head>
<body>

@include('includes.header')

@yield('content')

@include('includes.footer')

<script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/assets/js/countfect.min.js') }}"></script>
<script src="{{ asset('/assets/js/script.js') }}"></script>
@stack('scripts')

</body>
</html>