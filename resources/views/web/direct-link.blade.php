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
    <title>دوره لباس عروسک</title>
    <style>
        .yummy {
            color: #fff;
            padding: 4px 8px 5px;
            border: 1px solid #9fa3a7;
            text-decoration: none;
            /*text-shadow: 0 1px 0 rgba(0,0,0,0.3);*/

            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            background-color: #008fcf;
            box-shadow:
                    0 1px 0 rgba(0,0,0,.08),
                    inset 0 1px 2px rgba(255,255,255,.67),
                    inset 0 -1px 0 rgba(0,0,0,.14);
            background-image: -moz-linear-gradient(90deg, #a3a9ad 0%, #c5c9cd 100%);
            background-image: -o-linear-gradient(90deg, #a3a9ad 0%, #c5c9cd 100%);
            background-image: -webkit-linear-gradient(90deg, #a3a9ad 0%, #c5c9cd 100%);
            background-image: linear-gradient(90deg, #a3a9ad 0%, #c5c9cd 100%);
        }

        .submit_btn {
            display: flex;
            background: #FBC53B;
            box-shadow: 0 9px 0 #d59900;
            border-radius: 15px;
            justify-content: center;
            align-items: center;
            padding: 10px 33px;
            gap: 4px;
            font-weight: 800;
            font-size: 20px;
            line-height: 29px;
            text-align: center;
            cursor: pointer;
        }

    </style>
</head>
<body class="bg-light">
<div class="container">

    <div class="row px-2">

        <div class="col-lg-6 col-md-7 col-10 mx-auto bg-white mt-5 rounded shadow-sm py-3">

            <form method="POST" action="{{ route('direct_link') }}"><!-- start login form -->
                @csrf

                <div class="input-group signup-form mb-4">

                    <span class="input-group-text"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control form-control-lg" placeholder="نام و نام خانوادگی" name="name">

                </div>

                <div class="input-group signup-form mb-4">

                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                    <input type="text" class="form-control form-control-lg" placeholder="شماره تلفن همراه" name="mobile">

                </div>

{{--                <button type="submit" class="btn btn-lg btn-warning d-block mx-auto px-5 font-18 vazir-font my-3 yummy">ثبت نام و شروع آموزش</button>--}}
                <button type="submit" class="submit_btn">ثبت نام و شروع آموزش</button>

            </form><!-- end login form -->

        </div>

    </div>

</div>
</body>
</html>