@extends('layouts.app')
@section('title', 'صفحه اصلی')

@section('content')

    @if(session('status'))
        <div class="container mt-4">
            <div class="alert alert-{{session('status')}}">
                <span class="font-15">{{ session('message') }}</span>
            </div>
        </div>
    @endif

    <div class="container">

        <div class="row">

            @include('includes.user_panel.sidebar')

            <div class="col-lg-9">

                <div class="card my-3 p-3 shadow-sm">

                    <div class="row mt-4 mx-1  bg-light rounded p-3 shadow-sm"><!-- start notifications -->

                        <span class="font-13"><i class="fa fa-bell align-middle text-warning font-18 me-1"></i>دوره ها</span>

                        <div class="col-12">

                            <div class="d-flex justify-content-between align-items-center mt-4">

                                <strong class="font-18">برای دیدن دوره های ثبت نام شده <a href="/panel/courses">اینجا</a> کلیک کنید</strong>

                            </div>

                        </div>

                    </div><!-- end notifications -->

                </div>

                <div class="card my-3 p-3 shadow-sm">

                    <div class="row mt-4 mx-1  bg-light rounded p-3 shadow-sm"><!-- start notifications -->

                        <span class="font-13"><i class="fa fa-bell align-middle text-warning font-18 me-1"></i>جدیدترین اطلاعیه ها</span>

                        <div class="col-12">

                            <div class="d-flex justify-content-between align-items-center mt-4">

                                <p class="font-12">اطلاعیه جدیدی موجود نیست.</p>

                                <span class="font-13 text-muted">1402/07/21<i class="fa fa-calendar font-14 ms-2"></i></span>

                            </div>

                        </div>

                    </div><!-- end notifications -->

                </div>

            </div>

        </div>

    </div>

@endsection