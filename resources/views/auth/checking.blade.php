@extends('layouts.auth')
@section('title', 'ورود یا ثبت نام')

@section('content')

    <div class="row px-2">

        <div class="col-lg-6 col-md-7 col-10 mx-auto bg-white mt-5 rounded text-center shadow-sm py-3">

            @include('includes.logo')
            <h3 class="mb-4">ورود یا ثبت‌نام</h3>

            <form method="POST" action="{{ route('auth.checking') }}"><!-- start signup form -->
                @csrf

                @error('mobile')
                    <div class="alert alert-danger font-12 m-0 mb-2">{{ $message }}</div>
                @enderror
                <div class="input-group signup-form mb-4">

                    <span class="input-group-text"><i class="fa fa-phone"></i></span>

                    <input type="tel" class="form-control form-control-lg @error('mobile') is-invalid @enderror"
                           name="mobile" placeholder=" شماره موبایل را وارد کنید " value="{{old('mobile')}}" required autofocus>

                </div>

                <div class="form-check">

                    <label class="form-check-label line-height font-12" for="customCheck">

                        ثبت نام یا ورود به معنای پذیرش <a href="#" class="under-line">شرایط و قوانین</a> آکادمی عروسک‌سازی حیدری است.

                    </label>

                </div>

                <button type="submit" class="btn btn-lg btn-warning d-block mx-auto px-5 font-13 vazir-font my-3">تایید و دریافت کد</button>

            </form><!-- end signup form -->

        </div>

    </div>

@endsection

@push('styles')
    <style>
        ::placeholder {
            color: #262626 !important;
            font-weight: bold !important;
            opacity: 1; /* Firefox */
        }

        ::-ms-input-placeholder { /* Edge 12 -18 */
            color: #262626 !important;
            font-weight: bold !important;
        }
    </style>
@endpush