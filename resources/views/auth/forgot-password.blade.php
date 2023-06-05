@extends('layouts.theme')
@section('title', 'بازیابی رمز عبور')

@section('content')
    <div class="container">

        <div class="row px-2">

            <div class="col-lg-6 col-md-7 col-10 mx-auto bg-white mt-5 rounded shadow-sm py-3">

                <a href="/"><img src="assets/images/logo.jpg" alt="آموزش عروسک سازی حیدری" class="d-block mx-auto mb-4"></a><!-- logo -->

                @if($errors->any())
                <div class="alert alert-success font-12 mb-3">{{$errors->first()}}</div>
                @endif

                <form method="POST" action="{{ route('password.mobile') }}"><!-- start remember form -->
                    @csrf

                    @error('mobile')
                    <div class="alert alert-danger font-12 m-0">{{ $message }}</div>
                    @enderror
                    <div class="input-group signup-form mb-4">

                        <span class="input-group-text"><i class="fa fa-user"></i></span>

                        <input type="text" class="form-control form-control-lg @error('mobile') is-invalid @enderror"
                               placeholder="موبایل" name="mobile" value="{{old('mobile')}}" required autofocus>

                    </div>

                    <button type="submit" class="btn btn-lg btn-warning d-block mx-auto px-5 font-13 vazir-font my-3">بازیابی رمز عبور</button>

                </form><!-- end remember form -->

            </div>

        </div>

    </div>
@endsection