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
        .submit_btn {
            display: flex;
            background: #ffbf1b;
            box-shadow: 0 9px 0 #eaa800;
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
            margin: 20px auto 20px; /* Center the button using margin */
        }

        .discount-code-label {
            font-size: 13px;
            margin-right: 12%;
        }

        body {
            background-image: linear-gradient(rgb(89, 71, 241), rgb(349, 181, 231));
        }

        .direct-link-item {
            margin: 0 auto;
            width: 80%;
        }

        #cart-payment-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            color: black;
            text-decoration-line: underline;
        }

        .header-box {
            background-color: #8321d2;
            color: white;
            font-weight: 900;
            padding: 1em;
            border-bottom-left-radius: 2em;
            border-bottom-right-radius: 2em;
            margin-bottom: 1em;
        }

        .number {
            font-weight: 500;
            font-size: 2em;
            margin-left: 0.25em;
            color: #fff;
            background-color: #f10772;
            border-radius: 50%;
            display: inline-block;
            width: 1em;
            height: 1em;
            text-align: center;
        }

    </style>
</head>
<body>
<div class="container">
    @if (session('status'))
        <div class="card-body">
            <div class="alert alert-{{session('status')}} alert-dismissible">
                <h5>پیام سایت</h5>
                {{session('message')}}
            </div>
        </div>
    @endif
    <img src="{{ asset('/assets/images/direct_both_fadogh_dress.jpg') }}" width="100%" style="border-radius: 15px;">

    <form method="POST" action="{{ route('purchase-fandogh-dress') }}"><!-- start login form -->
        @csrf

        <div class="input-group mb-4 direct-link-item">

            <span class="input-group-text"><i class="fa fa-user"></i></span>

            <input type="text" class="form-control form-control-lg" placeholder="نام و نام خانوادگی" name="name">

        </div>

        <div class="input-group mb-1 direct-link-item">

            <span class="input-group-text"><i class="fa fa-phone"></i></span>
            <input type="text" class="form-control form-control-lg" placeholder="شماره تلفن همراه" name="mobile">

        </div>

        <button type="submit" id="register-and-payment-btn" class="submit_btn">ثبت نام و شروع آموزش</button>

    </form><!-- end login form -->

</div>
<script>
    function toggleButton() {
        var cart_payment = document.querySelector('#cart-payment');

        cart_payment.classList.toggle('d-none');
    }
</script>
</body>
</html>