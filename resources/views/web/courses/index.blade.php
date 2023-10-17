@extends('layouts.app')
@section('title', 'جستجوی دوره')

@section('content')

    @include('includes.user_panel.breadcrumb')

    <div class="container">

        <div class="row">

            <div class="col-lg-3"><!-- start side bar -->

                <div class="card bg-white shadow-sm p-2 mb-3"><!-- start box-1 -->

                    <p class="font-13 mt-3"><i class="fa fa-chevron-left align-middle font-12 text-info me-1"></i>جستجو در نتایج</p>

                    <div class="search-in-result position-relative">

                        <input type="search" class="form-control" placeholder="جستجو" >

                    </div>

                </div><!-- end box-1 -->

                <div class="card bg-white shadow-sm p-2 mb-3"><!-- start box-2 -->

                    <p class="font-13 mt-3"><i class="fa fa-chevron-left align-middle font-12 text-info me-1"></i>مرتب سازی براساس  </p>

                    <div class="form-check mb-2">

                        <input type="radio" class="form-check-input" id="item-4">

                        <label class="form-check-label font-12" for="item-4">جدیدترین</label>

                    </div>

                    <div class="form-check mb-2">

                        <input type="radio" class="form-check-input" id="item-5">

                        <label class="form-check-label font-12" for="item-5"> قدیمی ترین </label>

                    </div>

                    <div class="form-check mb-2">

                        <input type="radio" class="form-check-input" id="item-6">

                        <label class="form-check-label font-12" for="item-6">درحال برگزاری</label>

                    </div>

                    <div class="form-check mb-2">

                        <input type="radio" class="form-check-input" id="item-7">

                        <label class="form-check-label font-12" for="item-7">تکمیل شده ها </label>

                    </div>

                </div><!-- end box-2 -->

            </div><!-- end side bar -->

            <div class="col-lg-9">

                <div class="row"><!-- start course boxes -->

                    @foreach($courses as $course)
                        <div class="col-lg-4 col-sm-6 "><!-- start course item -->

                            <div class="card custom-card mb-3 shadow-sm">

                                <div class="sub-layer">

                                    <img src="{{$course->get_cover()}}" class="img-fluid" >

                                    <div class="over-layer">

                                        <a href="{{route('courses.show', ['course' => $course->id])}}" class="btn btn-info">مشاهده و خرید</a>

                                    </div>

                                </div>

                                <div class="card-body">

                                    <a href="{{route('courses.show', ['course' => $course->id])}}" class="text-dark d-block mb-2">{{$course->name}}</a>

                                    <p class="font-13 text-justify line-height vazir-font">{{$course->summery ?: 'برای توضیحات بیشتر کلیک کنید.'}}</p>

                                </div>

                                <div class="card-footer">

                                    <img src="/assets/images/hanie_heydari.png" class="team-icon">

                                    <span class="font-12 vazir-font">{{$course->teacher_name}}</span>

                                    <div class="float-end mt-1">

                                        @if($course->status == 'not_for_sale')
                                            <span class="text-danger font-12"> نامشخص </span>
                                        @elseif(!empty($course->price))
                                            @if(!empty($course->discount_percent))

                                                <del class="text-muted font-12 me-2">{{number_format($course->price) . ' تومان '}}</del>

                                                <span class="text-success font-12">{{number_format($course->price * (100 - $course->discount_percent) / 100) . ' تومان '}}</span>

                                            @else
                                                <span class="text-success font-12">{{number_format($course->price) . ' تومان '}}</span>
                                            @endif
                                        @else
                                            <span class="text-success font-12"> رایگان! </span>
                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div><!-- end course item -->
                    @endforeach

                </div><!-- end course boxes -->

                <ul class="pagination justify-content-center my-4 font-13"><!-- start pagination -->

                    <li class="page-item"><a href="#" class="page-link">&lsaquo;</a></li>

                    <li class="page-item active"><a href="#" class="page-link">1</a></li>

                    <li class="page-item"><a href="#" class="page-link">2</a></li>

                    <li class="page-item"><a href="#" class="page-link">3</a></li>

                    <li class="page-item"><a href="#" class="page-link">4</a></li>

                    <li class="page-item"><a href="#" class="page-link">&rsaquo;</a></li>

                </ul><!-- end pagination -->

            </div>

        </div>

    </div>

@endsection