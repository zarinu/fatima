@extends('layouts.auth')
@section('title', 'ثبت نام')

@section('content')

    <div class="row px-2">

        <div class="col-lg-6 col-md-7 col-10 mx-auto bg-white mt-5 rounded text-center shadow-sm py-3">

            @include('includes.logo')

            <form method="POST" action="{{ route('register') }}"><!-- start signup form -->
                @csrf

                <label for="name">لطفا نام خود را وارد کنید</label>
                @error('name')
                <div class="alert alert-danger font-12 m-0">{{ $message }}</div>
                @enderror
                <div class="input-group signup-form mb-4">

                    <span class="input-group-text"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                           name="name" placeholder=" نام و نام خانوادگی را وارد کنید " value="{{old('name')}}" required autofocus>

                </div>

                <label for="mobile">لطفا موبایل خود را وارد کنید</label>
                @error('mobile')
                <div class="alert alert-danger font-12 m-0">{{ $message }}</div>
                @enderror
                <div class="input-group signup-form mb-4">

                    <span class="input-group-text"><i class="fa fa-phone"></i></span>

                    <input type="tel" class="form-control form-control-lg @error('mobile') is-invalid @enderror"
                           name="mobile" placeholder=" شماره موبایل را وارد کنید " value="{{old('mobile')}}" required autofocus>

                </div>

                <label for="password">لطفا یک رمز عبور شامل 8 رقم انتخاب کنید</label>
                @error('password')
                <div class="alert alert-danger font-12 m-0">{{ $message }}</div>
                @enderror
                <div class="input-group signup-form mb-4">

                    <span class="input-group-text"><i class="fa fa-lock"></i></span>

                    <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                           name="password" placeholder=" رمز عبور را وارد کنید " required autofocus>

                </div>

                <label>لطفا تکرار رمز عبور انتخابی را وارد کنید</label>
                <div class="input-group signup-form mb-4">

                    <span class="input-group-text"><i class="fa fa-lock"></i></span>

                    <input type="password" class="form-control form-control-lg" name="password_confirmation"
                           placeholder=" تکرار رمز عبور را وارد کنید " required autofocus>

                </div>

                <div class="form-check">

                    <input class="form-check-input form-check-input-custom" type="checkbox" id="customCheck" checked>

                    <label class="form-check-label line-height font-12" for="customCheck">

                        <a href="#" class="text-dark under-line">حریم خصوصی</a> و <a href="#" class="text-dark under-line">شرایط و قوانین</a> استفاده از خدمات سایت دانشیار را مطالعه نموده و با کلیه موارد آن موافقم.

                    </label>

                </div>

                <button type="submit" class="btn btn-lg btn-warning d-block mx-auto px-5 font-13 vazir-font my-3">ثبت نام</button>

            </form><!-- end signup form -->

        </div>

    </div>

    <div class="row">

        <div class="col-lg-6 col-md-7 col-10 mx-auto bg-white mt-3 mb-5 rounded shadow-sm py-3 text-center"><!-- start login box -->

            <p class="font-13 mt-3">قبلا در سایت ثبت نام کرده اید؟ <a href="login" class="text-dark under-line">وارد شوید</a></p>

        </div><!-- end login box -->

    </div>

@endsection