@extends('layouts.auth')
@section('title', 'ورود با کد یکبار مصرف')

@section('content')
    <div class="container">

        <div class="row px-2">

            <div class="col-lg-6 col-md-7 col-10 mx-auto bg-white mt-5 rounded shadow-sm py-3">

                <div class="col-lg-2"><a href="/"><img src="/assets/images/hani_logo.png" width="184px" height="66px" alt="آموزش عروسک سازی حیدری"></a></div><!-- logo -->

                <form method="POST" action="{{ route('password.mobile') }}"><!-- start remember form -->
                    @csrf

                    @error('mobile')
                        <div class="alert alert-danger font-12 m-0 mb-2">{{$message}}</div>
                    @enderror
                    <div class="input-group signup-form mb-4">

                        <span class="input-group-text"><i class="fa fa-user"></i></span>

                        <input type="text" class="form-control form-control-lg @error('mobile') is-invalid @enderror"
                               placeholder="موبایل" name="mobile" value="{{old('mobile')}}" required autofocus>

                    </div>

                    <button type="submit" class="btn btn-lg btn-warning d-block mx-auto px-5 font-13 vazir-font my-3">دریافت کد یکبار مصرف </button>

                </form><!-- end remember form -->

            </div>

        </div>

        <div class="row">

            <div class="col-lg-6 col-md-7 col-10 mx-auto bg-white mt-3 mb-5 rounded shadow-sm py-3 text-center"><!-- start remember box -->

                <p class="font-13 mt-2">هنوز در سایت ثبت نام نکرده اید؟<a href="/register" class="text-dark under-line ms-1">ثبت نام </a></p>

                <p class="font-13 mt-3">ورود از طریق<a href="/login" class="text-dark under-line ms-1">رمز عبور </a></p>

            </div><!-- end remember box -->

        </div>

    </div>
@endsection