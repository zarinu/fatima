@extends('layouts.main')
@section('title', $course->name)

@section('content')
    <div class="container my-3"><!-- start breadcrumb -->

        <ul class="breadcrumb shadow-sm bg-light p-2">

            <li class="breadcrumb-item"><a href="/" class="font-12 vazir-font text-secondary">صفحه اصلی</a></li>

            <li class="breadcrumb-item"><a href="/courses" class="ps-2 font-12 vazir-font  text-secondary">دوره های عروسک سازی</a></li>

            <li class="breadcrumb-item"><a href="#" class="ps-2 font-12 vazir-font  text-secondary">{{$course->name}}</a></li>

        </ul>

    </div><!-- end breadcrumb -->

    <div class="container">

        <div class="row">

            <div class="col-lg-4"><!-- start course details -->

                <div class="card border-0"><!-- start video icon -->

                    <div class="sub-video-layer">

                        <img src="/assets/images/courses/{{$course->id}}/{{$course->cover_path}}" class="video-img">

                        <div class="over-video-layer">

                            <i class="fa fa-play play-video-icon"></i>

                        </div>

                    </div>

                </div><!-- start video icon -->

                <ul class="list-group text-center mt-3">

                    <li class="list-group-item font-13 py-3">{{$course->name}}</li>

                    <li class="list-group-item font-13 py-3">مدرس : {{$course->teacher_name}}</li>

                    <li class="list-group-item font-13 py-3">وضعیت دوره : تکمیل شده</li>

                    <li class="list-group-item font-13 py-3">قسمت های ارسالی : {{$course->uploaded_count}}</li>

                    <li class="list-group-item font-13 py-3">قیمت دوره : {{$course->price}} تومان</li>

                </ul>

                <button class="btn btn-info btn-block mt-3 py-2 font-13"><i class="fa fa-cart-plus align-middle"></i> افزودن به سبد خرید</button>

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

                <img src="/assets/images/courses/{{$course->id}}/{{$course->banner_path}}" class="img-fluid rounded mb-3" width="730" height="450">

                <h1 class="font-14 my-3">{{$course->name}}</h1>

                <p class="vazir-font font-13 text-justify line-height">{{$course->description}}</p>

                <p class="font-14 my-3">سر فصل ها  :</p>

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
                        <p class="m-3">برای دیدن و دانلود کلیک کنید:</p>
                        @foreach($chapter->lessons as $lesson)

                            <div class="m-3">
                                <i class="fa fa-video"></i>

                                <a href="/courses/{{$course->id}}/lessons/{{$lesson->id}}" class="m-1 lesson-field">{{$lesson->title}}</a>

                                @if($lesson->is_completed)
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

                                <textarea  class="form-control" rows="5" placeholder="متن دیدگاه شما"></textarea>

                                <button type="submit" class="btn btn-lg btn-info float-end font-13 my-3">ثبت دیدگاه</button>

                            </div>

                        </div><!-- end comment form -->

                        <div class="row"><!-- start comment box -->

                            <div class="col-12 bg-light shadow-sm mb-3 p-2 pb-3"><!-- start comment item -->

                                <div class="d-flex justify-content-between align-items-center">

                                    <div class="d-flex">

                                        <div>

                                            <img src="/assets/images/user-1.png" class="comment-pic">

                                        </div>

                                        <div>

                                            <span class="font-13 d-block ms-3 mt-3">آرش سبحانی</span>

                                            <div class="d-flex ms-3 mt-3">

                                                <i class="fa fa-star me-1 font-13 text-warning"></i>

                                                <i class="fa fa-star me-1 font-13 text-warning"></i>

                                                <i class="fa fa-star me-1 font-13 text-warning"></i>

                                                <i class="fa fa-star me-1 font-13 text-warning"></i>

                                                <i class="fa fa-star me-1 font-13 text-warning"></i>

                                            </div>

                                        </div>

                                    </div>

                                    <span class="font-12 text-muted"> <i class="fa fa-calendar font-14 me-2"></i> 20 بهمن 1401 </span>

                                </div>

                                <p class="font-13 vazir-font line-height px-5 mt-3">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                                    از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای
                                    شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                </p>

                                <div class="d-fex px-5">

                                    <span class="font-12 me-4"><i class="far fa-heart text-danger font-15 me-1"></i>(12)</span>

                                    <span class="font-12 me-4"><i class="far fa-thumbs-up text-success font-15 me-1"></i>(8)</span>

                                    <span class="font-12 me-4"><i class="far fa-thumbs-down text-muted font-15 me-1"></i>(0)</span>

                                </div>

                                <div class="bg-white shadow-sm mx-5 mt-3 p-3 rounded"><!-- start reply box -->

                                    <div class="d-flex justify-content-between align-items-center">

                                        <p class="font-13 text-danger">مدیر سایت</p>

                                        <span class="font-12 text-muted"> <i class="fa fa-calendar font-14 me-2"></i> 21 بهمن 1401 </span>

                                    </div>

                                    <p class="font-13 vazir-font line-height">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                                        از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای
                                        شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                    </p>

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

                                        <span class="font-12 text-muted me-4"><i class="fa fa-video me-1 text-danger"></i>72 ویدئو</span>

                                        <span class="font-12 text-muted me-4"><i class="fa fa-forward me-1 text-success"></i>2 دوره</span>

                                        <span class="font-12 text-muted me-4"><i class="fa fa-user me-1"></i> عضویت 5سال</span>

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

        <a href="blog.html" class="title-btn align-self-start">همه دوره ها <i class="fa fa-arrow-left align-middle"></i></a>

    </div><!-- end title-->

    <div class="container"><!-- start course box -->

        <div class="row">

            <div class="col-lg-4 col-sm-6 "><!-- start course item -->

                <div class="card custom-card mb-3 shadow-sm">

                    <div class="sub-layer">

                        <img src="/assets/images/html.jpg" class="img-fluid" >

                        <div class="over-layer">

                            <a href="course.html" class="btn btn-info">مشاهده و خرید</a>

                        </div>

                    </div>

                    <div class="card-body">

                        <a href="course.html" class="text-dark d-block mb-2"> آموزش HTML </a>

                        <p class="font-13 text-justify line-height vazir-font">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                            استفاده از طراحان گرافیک است.
                            چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است.
                        </p>

                    </div>

                    <div class="card-footer">

                        <img src="/assets/images/team_2.jpg" class="team-icon">

                        <span class="font-12 vazir-font">علی نوروزی</span>

                        <div class="float-end mt-1">

                            <span class="text-success font-12">رایگان !</span>

                        </div>

                    </div>

                </div>

            </div><!-- end course item -->


            <div class="col-lg-4 col-sm-6"><!-- start course item -->

                <div class="card custom-card mb-3 shadow-sm">

                    <div class="sub-layer">

                        <img src="/assets/images/flutter.png" class="img-fluid" >

                        <div class="over-layer">

                            <a href="course.html" class="btn btn-info">مشاهده و خرید</a>

                        </div>

                    </div>

                    <div class="card-body">

                        <a href="course.html" class="text-dark d-block mb-2"> آموزش حرفه ای Flutter</a>

                        <p class="font-13 text-justify line-height vazir-font">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                            استفاده از طراحان گرافیک است.
                            چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است.
                        </p>

                    </div>

                    <div class="card-footer">

                        <img src="/assets/images/team_4.jpg" class="team-icon">

                        <span class="font-12 vazir-font">سارا رضایی</span>

                        <div class="float-end mt-1">

                            <del class="text-muted font-12 me-2">320.000 تومان</del>

                            <span class="text-success font-12">200.000 تومان</span>

                        </div>

                    </div>

                </div>

            </div><!-- end course item -->


            <div class="col-lg-4 col-sm-6"><!-- start course item -->

                <div class="card custom-card mb-3 shadow-sm">

                    <div class="sub-layer">

                        <img src="/assets/images/js.png" class="img-fluid">

                        <div class="over-layer">

                            <a href="course.html" class="btn btn-info">مشاهده و خرید</a>

                        </div>

                    </div>

                    <div class="card-body">

                        <a href="course.html" class="text-dark d-block mb-2">آموزش پیشرفته جاوا اسکریپت</a>

                        <p class="font-13 text-justify line-height vazir-font">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                            استفاده از طراحان گرافیک است.
                            چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است.
                        </p>

                    </div>

                    <div class="card-footer">

                        <img src="/assets/images/team_2.jpg" class="team-icon">

                        <span class="font-12 vazir-font">علی نوروزی</span>

                        <div class="float-end mt-1">

                            <span class="text-success font-12">400.000 تومان</span>

                        </div>

                    </div>

                </div>

            </div><!-- end course item -->

        </div>

    </div><!-- end course box -->
    <script>
        var toggleButtons = document.querySelectorAll('.show-lessons-button');
        toggleButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var content = this.nextElementSibling;
                content.classList.toggle('open');
            });
        });
    </script>
@endsection