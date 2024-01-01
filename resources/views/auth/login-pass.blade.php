@extends('layouts.auth')
@section('title', 'ورود')

@section('content')

    <div class="row px-2">

        <div class="col-lg-6 col-md-7 col-10 mx-auto bg-white mt-5 rounded shadow-sm py-3 text-center">

            @include('includes.logo')
            <h3 class="mb-4">ورود با رمزعبور</h3>

            <p class="font-14">رمز عبور خود را برای {{$mobile}} وارد کنید.</p>

            <form method="POST" action="{{ route('login.pass') }}"><!-- start login form -->
                @csrf

                <input type="hidden" name="mobile" value="{{$mobile}}">

                @error('password')
                    <div class="alert alert-danger font-12 m-0 mb-2">{{ $message }}</div>
                @enderror
                <div class="input-group signup-form mb-4">

                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                           placeholder=" لطفا رمز عبور را وارد کنید " name="password" value="{{old('password')}}" required autofocus>

                </div>

                <button type="submit" class="btn btn-lg btn-warning d-block mx-auto px-5 font-13 vazir-font my-3">ورود</button>

            </form><!-- end login form -->

        </div>

    </div>
@endsection