@extends('layouts.auth')
@section('title', 'ثبت نام')

@section('content')
    <div class="row px-2">

        <div class="col-lg-6 col-md-7 col-10 mx-auto bg-white mt-5 rounded text-center shadow-sm py-3">

            @include('includes.logo')
            <h3 class="mb-4">وارد کردن کد ارسالی</h3>

            <p class="color-green font-14">کد یکبارمصرف به {{$mobile}} ارسال شد.</p>

            <form method="POST" id="register-form" action="{{ route('register') }}"><!-- start register form -->
                @csrf

                @error('verify_code')
                <div class="alert alert-danger font-12 m-0 mb-2">{{$message}}</div>
                @enderror
                <div class="input-group signup-form mb-4">

                    <input type="text" class="form-control form-control-lg @error('verify_code') is-invalid @enderror"
                           placeholder="کد تایید" id="code" name="verify_code" required autofocus>

                    <input type="hidden" name="mobile" value="{{$mobile}}">

                </div>

                <button type="submit" class="btn btn-lg btn-warning d-block mx-auto px-5 font-13 vazir-font my-3">تایید و ورود</button>

            </form><!-- end register form -->

        </div>

    </div>

@endsection
@push('scripts')
    <script>
        $('#code').on("change paste keyup", function(){
            if($(this).val().length >= 4){
                $('#register-form').submit()
            }
        });
    </script>
@endpush