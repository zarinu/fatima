@extends('layouts.app')
@section('title', $course->name)

@section('content')

    @include('includes.user_panel.breadcrumb')

    <div class="container mt-4">
        @if(session('status'))
            <div class="alert alert-{{session('status')}}">
                <span class="font-15">{{ session('message') }}</span>
            </div>
        @endif
    </div>

    <div class="container">

        <div class="row">

            <div class="col-lg-4"><!-- start course details -->

                <div class="card border-0"><!-- start video icon -->

                    <div class="sub-video-layer">

                        @if(!empty($course->get_video()))
                            <video class="video-img" id="introduction-video" loop>

                                <source src="{{$course->get_video()}}" type="video/mp4">
                                Your browser does not support the video tag.

                            </video>
                        @else
                            <img class="video-img" src="/assets/images/default/video-imgae.jpg">
                        @endif

                        <div class="over-video-layer" id="play-pause-button">

                            <i class="fa fa-play play-video-icon"></i>

                        </div>

                    </div>

                </div><!-- start video icon -->

                <ul class="list-group text-center mt-3">

                    <li class="list-group-item font-13 py-3">{{$course->name}}</li>

                    <li class="list-group-item font-13 py-3">مدرس : {{$course->teacher_name}}</li>

                    <li class="list-group-item font-13 py-3">وضعیت دوره : {{\App\Models\Course::$statuses[$course->status]}}</li>

                    <li class="list-group-item font-13 py-3">تعداد جلسات : {{$course->uploaded_count}} جلسه </li>

                    @if($course->status == 'not_for_sale')
                        <li class="list-group-item font-13 py-3"> قیمت دوره : نامشخص </li>
                    @elseif(!empty($course->price))
                        @if(!empty($course->discount_percent))

                            <li class="list-group-item font-13 py-3">
                                <span class="text-success text-bold font-18 m-3">{{$course->discount_percent}}<i class="fa fa-percent"></i> تخفیف </span>

                                <del class="text-muted font-12 me-2">{{number_format($course->price)}}</del>

                                <span class="text-success text-bold font-14">{{number_format(\App\Models\Course::calculate_discounted_price($course->price, $course->discount_percent)) . ' تومان '}}</span>
                            </li>
                        @else
                            <li class="list-group-item font-13 py-3"> قیمت دوره : {{number_format($course->price)}} تومان</li>
                        @endif
                    @else
                        <li class="list-group-item font-13 py-3">قیمت دوره : رایگان </li>
                    @endif

                </ul>

                <a class="btn btn-info btn-block mt-3 py-2 font-13" href="{{ route('cart.add', $course->id) }}"><i class="fa fa-cart-plus align-middle"></i> افزودن به سبد خرید</a>

                <div class="card my-3 p-3"><!-- start tags -->

                    <p class="font-13"><i class="fa fa-tag align-middlle text-muted me-2 font-12"></i>برچسب ها :</p>

                    <div>

                        <span class="font-13 vazir-font bg-light p-1 border rounded">آموزش عروسک سازی</span>

                        <span class="font-13 vazir-font bg-light p-1 border rounded">عروسک خنگول</span>

                        <span class="font-13 vazir-font bg-light p-1 border rounded">عروسک روسی</span>

                    </div>

                </div><!-- end tags -->

            </div><!-- end course details -->

            <div class="col-lg-8"><!-- start course content -->

                <div class="sub-layer">
                    <img src="{{$course->get_cover()}}" class="img-fluid rounded mb-3" width="730" height="450">

                    <!-- discount percent icon -->
                    @if($course->discount_percent)
                        <div class="over-layer-discount">
                            <img src="/assets/images/discount.png" width="150px">
                        </div>
                    @endif

                </div>

                <h1 class="font-14 my-3">{{$course->name}}</h1>

                <p class="vazir-font font-13 text-justify line-height">{!! $course->description !!}</p>

                <p class="font-14 my-3">سر فصل ها :</p>

                @foreach($course->chapters as $chapter)
                    <div class="d-flex align-items-center justify-content-between bg-light rounded shadow-sm mb-3 p-3 show-lessons-button"><!-- start course list item -->

                        <div class="d-flex align-items-center">

                            @if($chapter->order%2 == 0)
                                <i class="fa fa-check lock-icon"></i>
                            @else
                                <i class="fa fa-check play-icon"></i>
                            @endif

                            <p class="font-13 ms-2 vazir-font mt-3">{{$chapter->name}}</p>

                        </div>

                        <a href="#"><i class="fa fa-download text-muted"></i></a>

                    </div><!-- end course list item -->
                    <div class="mt-3 mb-3 rounded shadow-sm lessons-list bg-light">
                        @if(auth()->check() && auth()->user()->is_my_course($course))

                            @if($chapter->lessons->first())
                                <p class="m-3">برای دیدن و دانلود کلیک کنید:</p>
                            @endif
                            @foreach($chapter->lessons as $lesson)
                                <div class="m-3">
                                    <i class="fa fa-video"></i>

                                    <a href="{{route('lessons.show', ['course' => $course->id, 'lesson' => $lesson->id])}}" class="m-1 lesson-field">{{$lesson->title}}</a>

                                    @if($lesson->is_complete)
                                        <div class="float-end color-green">
                                            <i class="fa fa-check-circle"></i>
                                            <span class="lesson-check-complete"> تکمیل شده </span>
                                        </div>
                                    @else
                                        <div class="float-end color-red">
                                            <i class="fa fa-check-circle"></i>
                                            <span class="lesson-check-complete"> تکمیل نشده </span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach

                        @else
                            <p class="m-3 font-13">این بخش خصوصی می باشد. برای دسترسی کامل به دروس این دوره باید این دوره را خریداری نمایید.</p>
                        @endif
                    </div>
                @endforeach

            </div><!-- end course content -->

        </div>

    </div>

    <div class="container"><!-- start nav box -->

        <div class="row px-2">

            <div class="col-12 p-0">

                <ul class="nav nav-tabs nav-tabs-custome"><!-- start nav tabs -->

                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#comments">دیدگاه دانش آموختگان </a></li>

                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#description">معرفی مدرس</a></li>

                </ul><!-- end nav box -->

                <div class="tab-content border border-top-0 pt-4 pb-2 px-4"><!-- start tab contents -->

                    <div class="tab-pane active" id="comments"><!-- start comment tab -->

                        <div class="row"><!-- start comment form -->

                            <div class="col">

                                <input type="text" class="form-control form-control-lg" placeholder="نام و نام خانوادگی">

                            </div>

                            <div class="col">

                                <input type="text" class="form-control form-control-lg" placeholder="ایمیل">

                            </div>

                        </div>

                        <div class="row mt-3">

                            <div class="col-12">

                                <textarea class="form-control" rows="5" placeholder="متن دیدگاه شما"></textarea>

                                <button type="submit" class="btn btn-lg btn-info float-end font-13 my-3">ثبت دیدگاه</button>

                            </div>

                        </div><!-- end comment form -->

                        <div class="row"><!-- start comment box -->

                            <div class="col-12 bg-light shadow-sm mb-3 p-2 pb-3"><!-- start comment item -->

                                <div class="d-flex justify-content-between align-items-center">

                                    <div class="d-flex">

                                        <div>

                                            <img src="/assets/images/user-2.png" class="comment-pic">

                                        </div>

                                        <div>

                                            <span class="font-13 d-block ms-3 mt-3">کاربر دوره</span>

                                            <div class="d-flex ms-3 mt-3">

                                                <i class="fa fa-star me-1 font-13 text-warning"></i>

                                                <i class="fa fa-star me-1 font-13 text-warning"></i>

                                                <i class="fa fa-star me-1 font-13 text-warning"></i>

                                                <i class="fa fa-star me-1 font-13 text-warning"></i>

                                                <i class="fa fa-star me-1 font-13 text-warning"></i>

                                            </div>

                                        </div>

                                    </div>

                                    <span class="font-12 text-muted"> <i class="fa fa-calendar font-14 me-2"></i> 18 مهر 1402 </span>

                                </div>

                                <p class="font-13 vazir-font line-height px-5 mt-3">باسلام. خیلی ممنونم از دوره بسیار خوبتون توضیحات خیلی کمک کننده بود.</p>

                                <div class="d-fex px-5">

                                    <span class="font-12 me-4"><i class="far fa-heart text-danger me-1"></i>(0)</span>

                                    <span class="font-12 me-4"><i class="far fa-thumbs-up text-success me-1"></i>(0)</span>

                                    <span class="font-12 me-4"><i class="far fa-thumbs-down text-muted me-1"></i>(0)</span>

                                </div>

                                <div class="bg-white shadow-sm mx-5 mt-3 p-3 rounded"><!-- start reply box -->

                                    <div class="d-flex justify-content-between align-items-center">

                                        <p class="font-13 text-danger">مدیر سایت</p>

                                        <span class="font-12 text-muted"> <i class="fa fa-calendar font-14 me-2"></i> 20 مهر 1402 </span>

                                    </div>

                                    <p class="font-13 vazir-font line-height">نظر لطف شماست عزیز</p>

                                </div><!-- end reply box -->

                            </div><!-- end comment item -->

                        </div><!-- end comment box -->

                    </div><!-- end comment tab -->

                    <div class="tab-pane fade" id="description"><!-- start description tab -->

                        <div class="row mt-5">

                            <div class="col-12">

                                <div class="row">

                                    <div class="col-lg-3 col-md-4"><img src="/assets/images/teacher.jpeg" class="img-fluid rounded my-3 mx-auto d-block"></div>

                                    <div class="col-lg-9 col-md-8">

                                        <p class="mt-4">حانیه حیدری</p>

                                        <span class="font-12 text-muted me-4"><i class="fa fa-video me-1 text-danger"></i> {{\App\Models\Lesson::count()}} ویدئو </span>

                                        <span class="font-12 text-muted me-4"><i class="fa fa-forward me-1 text-success"></i> {{\App\Models\Course::count()}} دوره </span>

                                        <span class="font-12 text-muted me-4"><i class="fa fa-user me-1"></i> 5 سال تجربه </span>

                                        <p class="font-13 line-height vazir-font text-justify my-3">من، حانیه حیدری، ۵ سال عروسک ساختم و تو اینکار حرفه ایم و کنارتم تا تو هم حرفه ای بشی</p>

                                        <div class="teacher-social-media">

                                            <a href="#"><i class="fab fa-instagram"></i></a>

                                            <a href="#"><i class="fab fa-twitter"></i></a>

                                            <a href="#"><i class="fab fa-telegram"></i></a>

                                            <a href="#"><i class="fab fa-linkedin"></i></a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div><!-- end description tab -->

                </div><!-- end tab contents -->

            </div>

        </div>

    </div><!-- end nav box -->

    <div class="container d-flex justify-content-between mt-5 mb-4"><!-- start title-->

        <div class="title">

            <p class="font-14 ps-2">دوره های پیشنهادی</p>

            <p class="font-12 ps-3 text-muted">سکوی پرتاپ شما به سمت موفقیت</p>

        </div>

        <a href="/courses" class="title-btn align-self-start">همه دوره ها <i class="fa fa-arrow-left align-middle"></i></a>

    </div><!-- end title-->

    @include('includes.suggested_courses')

@endsection

@push('scripts')
    <script>
        var toggleButtons = document.querySelectorAll('.show-lessons-button');
        toggleButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var content = this.nextElementSibling;
                content.classList.toggle('open');
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            const video = $('#introduction-video')[0]; // Convert the jQuery object to a regular DOM element
            const playPauseButton = $('#play-pause-button');

            playPauseButton.click(function () {
                if (video.paused) {
                    video.play();
                    playPauseButton.removeClass('over-video-layer')
                } else {
                    video.pause();
                }
            });
        });
    </script>
@endpush


@push('styles')
    <style>
        .over-layer-discount {
            position: absolute;
            top: -10px;
            right: -25px;
            width: 100%;
            height: 100%;
            visibility: visible;
            opacity: 1;
            transition: all ease-in-out 0.2s;
        }
    </style>
@endpush