<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <title>آموزش عروسک سازی حیدری | @yield('title')</title>
    @stack('styles')
</head>
<body class="bg-light">
    <div class="container">
        @yield('content')
        <script src="{{ asset('/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        @stack('scripts')
    </div>
</body>
</html>
