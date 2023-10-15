@extends('layouts.auth')
@section('title', '404')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-lg-7 mx-auto text-center mt-5">

                <p class="mt-3">صفحه مورد نظر یافت نشد!</p>

                <img src="/assets/images/404.jpg" alt="Error 404" class="img-fluid">

                <a href="/" class="btn btn-lg btn-info font-13 my-3">بازگشت به صفحه اصلی</a>

            </div>

        </div>

    </div>

@endsection