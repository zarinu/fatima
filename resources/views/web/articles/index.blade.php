@extends('layouts.app')
@section('title', 'بلاگ')

@section('content')

    @include('includes.user_panel.breadcrumb')

    <div class="container">

        <div class="row">

            <div class="col-md-3"><!-- start side bar -->

                <div class="card bg-white shadow-sm p-2 mb-3"><!-- start box-1 -->

                    <p class="font-13 mt-3"><i class="fa fa-chevron-left align-middle font-12 text-info me-1"></i>جستجو در نتایج</p>

                    <div class="search-in-result position-relative">

                        <input type="search" class="form-control" placeholder="دنبال چی میگردی ؟" >

                    </div>

                </div><!-- end box-1 -->

                <div class="card bg-white shadow-sm p-2 mb-3"><!-- start box-2 -->

                    <p class="font-13 mt-3"><i class="fa fa-chevron-left align-middle font-12 text-info me-1"></i>مرتب سازی براساس</p>

                    <div class="form-check mb-2">

                        <input type="radio" class="form-check-input" id="item-1">

                        <label class="form-check-label font-12" for="item-1"> جدیدترین </label>

                    </div>

                    <div class="form-check mb-2">

                        <input type="radio" class="form-check-input" id="item-2">

                        <label class="form-check-label font-12" for="item-2"> قدیمی ترین </label>

                    </div>

                </div><!-- end box-2 -->

                {{--                <div class="card bg-white shadow-sm p-2 mb-3"><!-- start box-3 -->--}}

                {{--                    <p class="font-13 mt-3"><i class="fa fa-chevron-left align-middle font-12 text-info me-1"></i> دسته بندی </p>--}}

                {{--                    <div class="form-check mb-2">--}}

                {{--                        <input type="checkbox" class="form-check-input" id="item-4">--}}

                {{--                        <label class="form-check-label font-12" for="item-4">عروسک روسی</label>--}}

                {{--                    </div>--}}

                {{--                    <div class="form-check mb-2">--}}

                {{--                        <input type="checkbox" class="form-check-input" id="item-5">--}}

                {{--                        <label class="form-check-label font-12" for="item-5"> گرافیک</label>--}}

                {{--                    </div>--}}

                {{--                    <div class="form-check mb-2">--}}

                {{--                        <input type="checkbox" class="form-check-input" id="item-6">--}}

                {{--                        <label class="form-check-label font-12" for="item-6">چند رسانه ای </label>--}}

                {{--                    </div>--}}

                {{--                </div><!-- end box-3 -->--}}

            </div><!-- end side bar -->

            <div class="col-md-9"><!-- start article boxes -->

                @foreach($articles as $article)

                    <div class="row mx-0 border py-2 rounded shadow-sm mb-3"><!-- start article item -->

                        @if($article->has_image)
                            <div class="col-lg-5">

                                <img src="/media/articles/{{$article->id}}/image.jpg" class="blog-pic">

                            </div>
                        @endif

                        <div class="col-lg-7">

                            <a href="/articles/{{$article->id}}" class="font-14 text-dark d-block my-3">{{$article->title}}</a>

                            <p class="font-13 vazir-font text-justify line-height">{{$article->abstract}}</p>

                            <span class="font-12 me-2"><i class="fa fa-pen text-secondary align-middlle"></i> {{$article->author->name}} </span>

                            <span class="font-12 me-2"><i class="fa fa-calendar text-secondary align-middlle me-1"></i> {{\Morilog\Jalali\Jalalian::fromCarbon($article->created_at)->format('%d %B %Y')}} </span>

                            <span class="font-12">دسته بندی : عروسک سازی</span>

                            <a href="/articles/{{$article->id}}" class="btn btn-info font-12 float-end">ادامه مطلب</a>

                        </div>

                    </div><!-- end article item -->

                @endforeach

                <ul class="pagination justify-content-center my-4 font-13"><!-- start pagination -->

                    <li class="page-item"><a href="#" class="page-link">&lsaquo;</a></li>

                    <li class="page-item"><a href="#" class="page-link">1</a></li>

                    <li class="page-item active"><a href="#" class="page-link">2</a></li>

                    <li class="page-item"><a href="#" class="page-link">3</a></li>

                    <li class="page-item"><a href="#" class="page-link">4</a></li>

                    <li class="page-item"><a href="#" class="page-link">&rsaquo;</a></li>

                </ul><!-- end pagination -->

            </div><!-- end article boxes -->

        </div>

    </div>

@endsection

@push('styles')
@endpush