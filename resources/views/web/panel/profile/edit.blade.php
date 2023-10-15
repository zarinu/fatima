@extends('layouts.app')
@section('title', 'دوره های من')

@section('content')

    <div class="container">

        <div class="row">

            @include('includes.user_panel.sidebar')

            <div class="col-lg-9">

                <div class="card my-3 p-3 shadow-sm personal-info-form">

                    <p class="font-14">جزئیات حساب کاربری شما :</p>

                    <form><!-- start personal info form -->

                        <div class="mb-3">

                            <label for="name" class="form-label font-13 ">نام :</label>

                            <input type="text" class="form-control form-control-lg" id="name" value="آرش">

                        </div>

                        <div class="mb-3">

                            <label for="lastname" class="form-label font-13 ">نام خانوادگی :</label>

                            <input type="text" class="form-control form-control-lg" id="lastname" value="سبحانی">

                        </div>

                        <div class="mb-3">

                            <label for="username" class="form-label font-13 "> نام کاربری : </label>

                            <input type="text" class="form-control form-control-lg" id="username" value="arash-sb">

                        </div>

                        <div class="mb-3">

                            <label for="password" class="form-label font-13 "> رمز عبور :  </label>

                            <input type="password" class="form-control form-control-lg" id="password" value="123456789">

                        </div>

                        <div class="mb-3">

                            <label for="email" class="form-label font-13 ">  ایمیل:  </label>

                            <input type="email" class="form-control form-control-lg" id="email" value="arash.sb@gmail.com">

                        </div>

                        <label for="password" class="form-label font-13 mb-2"> عکس پروفایل :  </label>

                        <div class="input-group mb-3">

                            <input type="file" class="form-control form-control-lg" id="avatart" placeholder="انتخاب عکس">

                        </div>

                        <div class="mb-3">

                            <label for="email" class="form-label font-13 mb-2">دریافت خبرنامه :</label>

                            <select class="form-select">

                                <option>بله</option>

                                <option>خیر</option>

                            </select>

                        </div>


                        <button type="submit" class="btn btn-lg btn-info btn-block font-13 mt-4">ذخیره تغییرات </button>

                    </form><!-- end personal info form -->

                </div>

            </div>

        </div>

    </div>

@endsection