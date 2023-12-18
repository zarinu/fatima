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

                    <li class="list-group-item font-13 py-3">
                        امتیاز دوره :
                        <span class="text-warning">
                            <i class="fa fa-star" style="font-size: 18px !important;"></i>
                            <span class="font-15">{{$course->rate}} ({{$course->score}} رای)</span>
                        </span>
                    </li>

                    <li class="list-group-item font-13 py-3">مدرس : {{$course->teacher_name}}</li>

                    <li class="list-group-item font-13 py-3">وضعیت دوره : {{\App\Models\Course::$statuses[$course->status]}}</li>

                    @php $course_hours = (int)($course->total_hours/60) @endphp
                    <li class="list-group-item font-13 py-3">مدت زمان : {{$course_hours}} ساعت و {{$course->total_hours - $course_hours*60}} دقیقه</li>

                    @if($course->status == 'not_for_sale')
                        <li class="list-group-item font-13 py-3"> قیمت دوره : نامشخص </li>
                    @elseif(!empty($course->price))
                        @if(!empty($course->discount_percent))

                            <li class="list-group-item font-13 py-3">
                                <div class="row">

                                    <div class="col">
                                        <span class="text-bold font-18 m-3">{{$course->discount_percent}}<i class="fa fa-percent"></i> تخفیف </span>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <span class="text-success text-bold font-15">{{number_format(calculateDiscountedPrice($course->price, $course->discount_percent)) . ' تومان '}}</span>
                                        </div>
                                        <div class="row">
                                            <del class="text-muted font-12 me-2">{{number_format($course->price)}}</del>
                                        </div>
                                    </div>

                                </div>
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
                            <img src="/assets/images/discount.png" width="100px">
                        </div>
                    @endif

                </div>

                <h1 class="font-14 my-3">{{$course->name}}</h1>

                <div id="course_description">{!! $course->description !!}</div>

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

                                    @if($lesson->is_complete())
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

                        <form method="POST" action="/comments/store">
                            @csrf

                            <div class="row"><!-- start comment form -->

                                <input type="hidden" name="item_id" value="{{$course->id}}">

                                <div class="col-sm-4 mb-2">

                                    <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror"
                                           placeholder="نام و نام خانوادگی" value="{{old('name')}}">
                                    @error('name')
                                    <div class="text-danger font-12">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-sm-4">

                                    <input type="text" name="mobile" class="form-control form-control-lg @error('mobile') is-invalid @enderror"
                                           placeholder="موبایل (اختیاری)" value="{{old('mobile')}}">
                                    @error('mobile')
                                    <div class="text-danger font-12">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-sm-4">

                                    <span class="vazir-font font-12 line-height"> امتیاز شما به دوره </span>

                                    <span class="rating-star">
                                        <input type="radio" name="rate" value="5" {{old('rate') == 5 ? 'checked' : ''}}><span class="star"></span>

                                        <input type="radio" name="rate" value="4" {{old('rate') == 4 ? 'checked' : ''}}><span class="star"></span>

                                        <input type="radio" name="rate" value="3" {{old('rate') == 3 ? 'checked' : ''}}><span class="star"></span>

                                        <input type="radio" name="rate" value="2" {{old('rate') == 2 ? 'checked' : ''}}><span class="star"></span>

                                        <input type="radio" name="rate" value="1" {{old('rate') == 1 ? 'checked' : ''}}><span class="star"></span>
                                    </span>

                                    @error('rate')
                                    <div class="text-danger font-12">{{ $message }}</div>
                                    @enderror

                                </div>

                            </div>

                            <div class="row mt-3">

                                <div class="col-12">

                                    <textarea class="form-control @error('content') is-invalid @enderror" rows="5" name="content" placeholder="متن دیدگاه شما">{{old('content')}}</textarea>

                                    @error('content')
                                    <div class="text-danger font-12">{{ $message }}</div>
                                    @enderror

                                    <button type="submit" class="btn btn-lg btn-info float-end font-13 my-3">ثبت دیدگاه</button>

                                </div>

                            </div><!-- end comment form -->

                        </form>

                        <div class="row"><!-- start comment box -->

                            @foreach($comments as $comment)
                                <div class="col-12 bg-light shadow-sm mb-3 p-2 pb-3"><!-- start comment item -->

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div class="d-flex">

                                            <div>

                                                <img src="/assets/images/user-2.png" class="comment-pic">

                                            </div>

                                            <div>

                                                <span class="font-13 d-block ms-3 mt-3">{{$comment->name}}</span>

                                                <div class="d-flex ms-3 mt-3">
                                                    @php
                                                        $stars = (int)$comment->rate;
                                                        $mute_stars = 5 - $stars;
                                                    @endphp
                                                    @for($x = 1; $x <= $mute_stars; $x++)
                                                        <i class="fa fa-star-o me-1 font-13 text-warning"></i>
                                                    @endfor
                                                    @for($x = 1; $x <= $stars; $x++)
                                                        <i class="fa fa-star me-1 font-13 text-warning"></i>
                                                    @endfor

                                                </div>

                                            </div>

                                        </div>

                                        <span class="font-12 text-muted"> <i class="fa fa-calendar font-14 me-2"></i> {{\Morilog\Jalali\Jalalian::fromCarbon($comment->created_at)->format('%d %B %Y')}} </span>

                                    </div>

                                    <p class="font-13 vazir-font line-height px-5 mt-3"> {{$comment->content}} </p>

                                    <div class="d-fex px-5">

                                        <span class="font-15 me-4"><i class="far fa-comment text-danger me-1"></i>({{count($comment->children)}})</span>

                                        <span class="font-15 me-4"><a href="/comments/{{$comment->id}}/like"><i class="far fa-thumbs-up text-success me-1"></i></a>({{$comment->likes ?: 0}})</span>

                                        <span class="font-15 me-4"><a href="/comments/{{$comment->id}}/dislike"><i class="far fa-thumbs-down text-muted me-1"></i></a>({{$comment->dislikes ?: 0}})</span>

                                    </div>

                                    @foreach($comment->children()->where('status', 'active')->get() as $child_comment)
                                        <div class="bg-white shadow-sm mx-5 mt-3 p-3 rounded"><!-- start reply box -->

                                            <div class="d-flex justify-content-between align-items-center">

                                                <p class="font-13 text-danger"> {{$child_comment->name}} </p>

                                                <span class="font-12 text-muted"> <i class="fa fa-calendar font-14 me-2"></i> {{\Morilog\Jalali\Jalalian::fromCarbon($child_comment->created_at)->format('%d %B %Y')}} </span>

                                            </div>

                                            <p class="font-13 vazir-font line-height"> {{$child_comment->content}} </p>

                                        </div><!-- end reply box -->
                                    @endforeach

                                </div><!-- end comment item -->
                            @endforeach
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

                                        <span class="font-12 text-muted me-4"><i class="fa fa-user me-1"></i> 6 سال تجربه </span>

                                        <p class="font-13 line-height vazir-font text-justify my-3">من، حانیه حیدری، 6 سال عروسک ساختم و تو اینکار حرفه ایم و کنارتم تا تو هم حرفه ای بشی</p>

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
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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

    <script>
        $('#course_description *, #course_description').addClass('vazir-font font-14 text-justify line-height');
    </script>
@endpush


@push('styles')
    <style>
        .over-layer-discount {
            position: absolute;
            top: -12px;
            left: 17px;
            width: 100%;
            height: 100%;
            visibility: visible;
            opacity: 1;
            transition: all ease-in-out 0.2s;
        }

        .rating-star {
            direction: rtl;
            font-size: 40px;
            unicode-bidi: bidi-override;
            display: inline-block;
        }
        .rating-star input {
            opacity: 0;
            position: relative;
            left: -30px;
            z-index: 2;
            cursor: pointer;
        }
        .rating-star span.star:before {
            color: #777777;
        }
        .rating-star span.star {
            display: inline-block;
            font-family: FontAwesome;
            font-style: normal;
            font-weight: normal;
            position: relative;
            z-index: 1;
        }
        .rating-star span {
            margin-left: -30px;
        }
        .rating-star span.star:before {
            color: #777777;
            content:"\f006";
        }
        .rating-star input:hover + span.star:before, .rating-star input:hover + span.star ~ span.star:before, .rating-star input:checked + span.star:before, .rating-star input:checked + span.star ~ span.star:before {
            color: #ffd100;
            content:"\f005";
        }
    </style>
@endpush