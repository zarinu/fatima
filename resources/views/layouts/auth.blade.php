<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/assets/css/bootstrap.rtl.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>آموزش عروسک سازی حیدری | @yield('title')</title>
</head>
<body class="bg-light">
    <div class="container">
        @yield('content')
        <script src="/assets/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
</html>
