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
    <img src="{{ asset('/assets/images/dress_course.jpg') }}" width="100%" style="border-radius: 15px;">

    <form method="POST" action="{{ route('direct_link') }}"><!-- start login form -->
        @csrf

        <div class="input-group mb-4 direct-link-item">

            <span class="input-group-text"><i class="fa fa-user"></i></span>

            <input type="text" class="form-control form-control-lg" placeholder="نام و نام خانوادگی" name="name">

        </div>

        <div class="input-group mb-1 direct-link-item">

            <span class="input-group-text"><i class="fa fa-phone"></i></span>
            <input type="text" class="form-control form-control-lg" placeholder="شماره تلفن همراه" name="mobile">

        </div>

        <span class="discount-code-label">اگه کد تخفیف داری بزن 👇👇👇</span>
        <div class="input-group mb-2 direct-link-item">

            <span class="input-group-text"><i class="fa fa-percent"></i></span>
            <input type="text" class="form-control form-control-lg" placeholder="کد تخفیف" name="discount_code">

        </div>

        <button type="submit" id="register-and-payment-btn" class="submit_btn">ثبت نام و شروع آموزش</button>

    </form><!-- end login form -->

    <a id="cart-payment-btn" href="#cart-payment" onclick="toggleButton()">
                            <span class="icon">
                                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                                    <path d="M22 3c.53 0 1.039.211 1.414.586s.586.884.586 1.414v14c0 .53-.211 1.039-.586 1.414s-.884.586-1.414.586h-20c-.53 0-1.039-.211-1.414-.586s-.586-.884-.586-1.414v-14c0-.53.211-1.039.586-1.414s.884-.586 1.414-.586h20zm1 8h-22v8c0 .552.448 1 1 1h20c.552 0 1-.448 1-1v-8zm-15 5v1h-5v-1h5zm13-2v1h-3v-1h3zm-10 0v1h-8v-1h8zm-10-6v2h22v-2h-22zm22-1v-2c0-.552-.448-1-1-1h-20c-.552 0-1 .448-1 1v2h22z"></path>
                                </svg>
                            </span>
        پرداخت به صورت کارت به کارت
    </a>

    <div class="col-md-4 col-12 text-center mt-3 d-none" id="cart-payment">
        <div class="header-box">
            <h2>
                <span>ثبت نام دوره لباس عروسک</span>
                <span>به صورت کارت به کارت</span>
            </h2>
        </div>
        <div>
            <p class="steps">
                <span><span class="number">1</span> لطفا مبلغ 490,000 تومان</span>
                <span>را ابتدا به شماره کارت زیر واریز کنید:</span>
            </p>
        </div>
        <div class="mb-3" style="display:flex;justify-content: center;">
            <img style="border-radius: 8px;" class="img-fluid" src="{{asset('/assets/images/bank-pasargad.png')}}" alt="5022-2910-7932-4909">
        </div>
        <hr>
        <p class="steps">
            <span class="number">2</span>
            پس از انتقال با استفاده از دکمه زیر اطلاعات پرداختی
            خود را ثبت نمایید.</p>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item mb-4">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        ثبت اطلاعات پرداختی
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample" style="">
                    <div class="accordion-body">
                        <form id="card2cardForm" action="{{ route('direct_link_cart') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-4">
                                <input type="text" class="form-control" name="full_name" id="fullName" value="" placeholder="نام و نام خانوادگی: مجید حسینی">
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" class="form-control" name="phone" id="phone" value="" placeholder=" شماره همراه: 09121234567">
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" class="form-control" name="tracking_code" id="trackingCode" value="" placeholder=" کد پیگیری ( مرجع ): 25648947">
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" class="form-control" name="card_number" id="cardNumber" value="" placeholder="چهار رقم آخر کارت مبدا: 1234">
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" class="form-control pwt-datepicker-input-element" name="paid_date" id="paidDate" value="" placeholder="تاریخ واریز مبلغ">
                            </div>
                            <div class="form-group mb-3">
                                <label for="file" class="form-label">
                                        <span class="d-block mb-4">
                                            <svg class="scale-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M11.492 10.172l-2.5 3.064-.737-.677 3.737-4.559 3.753 4.585-.753.665-2.5-3.076v7.826h-1v-7.828zm7.008 9.828h-13c-2.481 0-4.5-2.018-4.5-4.5 0-2.178 1.555-4.038 3.698-4.424l.779-.14.043-.789c.185-3.448 3.031-6.147 6.48-6.147 3.449 0 6.295 2.699 6.478 6.147l.044.789.78.14c2.142.386 3.698 2.246 3.698 4.424 0 2.482-2.019 4.5-4.5 4.5m.978-9.908c-.212-3.951-3.472-7.092-7.478-7.092s-7.267 3.141-7.479 7.092c-2.57.463-4.521 2.706-4.521 5.408 0 3.037 2.463 5.5 5.5 5.5h13c3.037 0 5.5-2.463 5.5-5.5 0-2.702-1.951-4.945-4.522-5.408"></path></svg>
                                        </span>
                                    <span>
                                            با کلیک بر روی این قسمت اسکرین شاتی که از فیش پرداختی خود گرفته اید را آپلود کنید.
                                        </span>
                                    <span class="w-full mt-2 d-block">پسوند های مجاز: jpg, .jpeg, .png,  </span>
                                </label>
                                <input type="file" id="image" name="image" accept=".jpg,.png,.jpeg">
                            </div>

                            <button class="btn btn-success w-100 p-3 mb-8" type="submit" style="background-color: #8321d2">
                                ثبت اطلاعات
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<script>
    function toggleButton() {
        var cart_payment = document.querySelector('#cart-payment');

        cart_payment.classList.toggle('d-none');
    }
</script>
</body>
</html>