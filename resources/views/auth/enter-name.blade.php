@extends('layouts.auth')
@section('title', 'نام و نام خانوادگی')

@section('content')

    <div class="row px-2">

        <div class="col-lg-6 col-md-7 col-10 mx-auto bg-white mt-5 rounded text-center shadow-sm py-3">

            @include('includes.logo')
            <h3 class="mb-4">اسمتون چیه؟</h3>

            <form method="POST" action="{{ route('after_register.name') }}"><!-- start signup form -->
                @csrf

                @error('name')
                    <div class="alert alert-danger font-12 m-0 mb-2">{{ $message }}</div>
                @enderror
                <div class="input-group signup-form mb-4">

                    <span class="input-group-text"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                           name="name" placeholder=" نام و نام خانوادگی خود را وارد کنید " value="{{old('name')}}" required autofocus>

                </div>

                <button type="submit" class="btn btn-lg btn-warning d-block mx-auto px-5 font-13 vazir-font my-3">ورود و مشاهده دوره‌ها</button>

            </form><!-- end signup form -->

        </div>

    </div>

@endsection