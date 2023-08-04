@extends('layouts.auth')
@section('title', 'اعتبارسنجی کد یکبار مصرف')

@section('content')
    <div class="container">

        <div class="row px-2">

            <div class="col-lg-6 col-md-7 col-10 mx-auto bg-white mt-5 rounded shadow-sm py-3">

                <div class="col-lg-2"><a href="/"><img src="/assets/images/hani_logo.png" width="184px" height="66px" alt="آموزش عروسک سازی حیدری"></a></div><!-- logo -->

                <p class="color-green">کد فرستاده شده برای {{$mobile}} را وارد کنید.</p>

                <form method="POST" action="{{ route('check_code.mobile') }}"><!-- start remember form -->
                    @csrf

                    @error('verify_code')
                        <div class="alert alert-danger font-12 m-0 mb-2">{{$message}}</div>
                    @enderror
                    <div class="input-group signup-form mb-4">

                        <span class="input-group-text"><i class="fa fa-user"></i></span>

                        <input type="text" class="form-control form-control-lg @error('verify_code') is-invalid @enderror"
                               placeholder="کد تایید" name="verify_code" required autofocus>

                        <input type="hidden" name="mobile" value="{{$mobile}}">

                    </div>

                    <button type="submit" class="btn btn-lg btn-warning d-block mx-auto px-5 font-13 vazir-font my-3">ورود با کد یکبار مصرف</button>

                </form><!-- end remember form -->

            </div>

        </div>

        <div class="row">

            <div class="col-lg-6 col-md-7 col-10 mx-auto bg-white mt-3 mb-5 rounded shadow-sm py-3 text-center"><!-- start remember box -->

                <p class="font-13 mt-3"><a href="/forgot-password" class="text-dark under-line ms-1">تغییر شماره</a></p>

            </div><!-- end remember box -->

        </div>

    </div>
@endsection