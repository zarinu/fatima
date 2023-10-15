@extends('layouts.app')
@section('title', 'صفحه اصلی')

@section('content')

    <div class="d-none d-sm-block banner-3"><!-- start banner -->

        <div class="container">

            <div class="row">

                <div class="col-lg-6">

                    <h1>داستان عروسک‌ساز شدنت از اینجا شروع میشه!</h1>

                    <h6>یادگیری عروسک‌سازی آرزو نیست، فقط نیاز هست، تلاش و تمرین داشته باشید، بقیه‌اش با من</h6>

                    <a href="/courses" class="btn btn-custom-info">شروع یادگیری عروسک‌سازی <i class="fa fa-arrow-left align-middle mt-1"></i></a>

                    <div class="row pb-3"><!-- start banner icons -->

                        <div class="col-6 pt-4">

                            <i class="fas fa-chalkboard-teacher" id="chalkboard-icon"></i>

                            <span>بیش از 5سال سابقه</span>

                        </div>

                        <div class="col-6 pt-4">

                            <i class="fas fa-wallet" id="wallet-icon"></i>

                            <span>ضمانت بازگشت وجه</span>

                        </div>

                        <div class="col-6 pt-4">

                            <i class="fas fa-pen" id="pen-icon"></i>

                            <span>یادگیری با تمرین و آزمون</span>

                        </div>

                        <div class="col-6 pt-4">

                            <i class="fas fa-phone" id="phone-icon"></i>

                            <span>پشتیبانی ۲۴ساعته</span>

                        </div>

                    </div><!-- end banner icons -->

                </div>

                <div class="col-lg-6">

                    <img src="/assets/images/hanie_heydari.png" class="img-fluid">

                </div>

            </div>

        </div>

    </div><!-- end banner -->

    <div class="container"><!-- start category boxes -->

        <div class="row pt-5">

            <div class="col-md-3 col-6 mb-3"><a href="/courses/1"><img src="/assets/images/arosak_dress.png" class="img-fluid rounded"></a></div>

            <div class="col-md-3 col-6 mb-3"><a href="/register"><img src="/assets/images/login.png" class="img-fluid rounded"></a></div>

            <div class="col-md-3 col-6 mb-3"><a href="/courses"><img src="/assets/images/arosak_rosi.png" class="img-fluid rounded"></a></div>

            <div class="col-md-3 col-6 mb-3"><a href="/courses/2"><img src="/assets/images/fandogh.png" class="img-fluid rounded"></a></div>

        </div>

    </div><!-- end category boxes -->

    <div class="container d-flex justify-content-between mt-5 mb-4"><!-- start title-->

        <div class="title">

            <p class="font-14 ps-2">جدیدترین دوره های آموزشی</p>

            <p class="font-12 ps-3 text-muted">سکوی پرتاپ شما به سمت موفقیت</p>

        </div>

        <a href="/courses" class="title-btn align-self-start">همه دوره ها <i class="fa fa-arrow-left align-middle"></i></a>

    </div><!-- end title-->

    @include('includes.suggested_courses')

    <div class="container">

        <div class="row px-3 my-5">

            <div class="col-lg-5 shadow rounded mb-3">

                <div class="title my-4"><!-- start title-->

                    <p class="font-14 ps-2">درخواست مشاوره رایگان</p>

                    <p class="font-12 ps-3 text-muted">فرصت رو از دست نده!</p>

                </div> <!-- end title-->

                <form><!-- start contact form -->

                    <div class="mb-3">

                        <input type="text" class="form-control form-control-lg" placeholder="نام و نام خانوادگی ">

                    </div>

                    <div class="mb-3">

                        <input type="email" class="form-control form-control-lg" placeholder="ایمیل">

                    </div>

                    <div class="mb-4">

                        <input type="tel" class="form-control form-control-lg" placeholder="شماره تلفن">

                    </div>

                    <input type="submit" value="ثبت درخواست مشاوره" class="btn btn-info btn-lg font-13 mb-4">

                </form><!-- end contact form -->

            </div>

            <div class="col-lg-7 ps-3">

                <img src="/assets/images/banner2.jpg" class="img-fluid">

            </div>

        </div>

    </div><!-- contact us -->

    <div class="team-box"><!-- start comment slider -->

        <div class="container d-flex justify-content-between"><!-- start title-->

            <div class="title mt-5 mb-3">

                <p class="font-14 ps-2">نظرات شما</p>

                <p class="font-12 ps-3 text-muted">موفقیت شما با من !</p>

            </div>

        </div><!-- end title-->


        <div class="container">

            <div class="row">

                <div class="col-12">

                    <div class="owl-carousel owl-theme owl-rtl">

                        <div class="item"><!-- start comment item -->

                            <div class="card border-0 bg-white p-3 shadow-sm">

                                <div class="d-flex align-items-center justify-content-between mb-3">

                                    <div class="d-flex">

                                        <div>

                                            <img src="/assets/images/user-1.jpeg" class="comment-pic">

                                        </div>

                                        <div>

                                            <span class="font-13 d-block ms-2">هنرجو عروسک سازی</span>

                                            <span class="font-12 d-block ms-2 text-muted mt-1">لیسانس فناوری اطلاعات</span>

                                            <span class="student-rating"><i class="fa fa-star font-12 me-1"></i>4.9</span>

                                        </div>

                                    </div>

                                    <img src="/assets/images/c-1.png" class="comment-icon">

                                </div>

                                <p class="font-13 line-height vazir-font px-3 text-justify">
                                    راستش من لیسانس فناوری اطلاعات دارم ولی چون بچه کوچک دارم نمیتونم برم سرکار اما حالا دیگه از نظر روحی خیلی حالم خوب شده چون با عروسک سازی میتونم واسه خودم درآمد داشته باشم.
                                </p>

                            </div>

                        </div><!-- end comment item -->

                        <div class="item"><!-- start comment item -->

                            <div class="card border-0 bg-white p-3 shadow-sm">

                                <div class="d-flex align-items-center justify-content-between mb-3">

                                    <div class="d-flex">

                                        <div>

                                            <img src="/assets/images/user-2.png" class="comment-pic">

                                        </div>

                                        <div>

                                            <span class="font-13 d-block ms-2">هنرجو دوره فندق</span>

                                            <span class="font-12 d-block ms-2 text-muted mt-1">عروسک ساز</span>

                                            <span class="student-rating"><i class="fa fa-star font-12 me-1"></i>4.5</span>

                                        </div>

                                    </div>

                                    <img src="/assets/images/c-2.png" class="comment-icon">

                                </div>

                                <p class="font-13 line-height vazir-font px-3 text-justify">
                                    من باورم نمیشد عروسک فندق درست کنم چون خیلی لرزش دست شدید داشتم و با آموزش های شما تا الان ۲ تا عروسک فندق درست کردم
                                    و همه اینها رو مدیون خانم حیدری هستم.
                                </p>

                            </div>

                        </div><!-- end comment item -->

                        <div class="item"><!-- start comment item -->

                            <div class="card border-0 bg-white p-3 shadow-sm">

                                <div class="d-flex align-items-center justify-content-between mb-3">

                                    <div class="d-flex">

                                        <div>

                                            <img src="/assets/images/user-3.jpeg" class="comment-pic">

                                        </div>

                                        <div>

                                            <span class="font-13 d-block ms-2">نعیمه</span>

                                            <span class="font-12 d-block ms-2 text-muted mt-1">خانه دار</span>

                                            <span class="student-rating"><i class="fa fa-star font-12 me-1"></i>4.3</span>

                                        </div>

                                    </div>

                                    <img src="/assets/images/c-1.png" class="comment-icon">

                                </div>

                                <p class="font-13 line-height vazir-font px-3 text-justify">
                                    من خودم تدریس کار هنری کردم و میدونم نکات چقدر مهمه. اما ماشالا خانم حیدری تمام ریزه کاری ها رو هم توی دوره هاشون میگن.
                                </p>

                            </div>

                        </div><!-- end comment item -->

                        <div class="item"><!-- start comment item -->

                            <div class="card border-0 bg-white p-3 shadow-sm">

                                <div class="d-flex align-items-center justify-content-between mb-3">

                                    <div class="d-flex">

                                        <div>

                                            <img src="/assets/images/user-4.jpeg" class="comment-pic">

                                        </div>

                                        <div>

                                            <span class="font-13 d-block ms-2">زهرا</span>

                                            <span class="font-12 d-block ms-2 text-muted mt-1">دانش آموز</span>

                                            <span class="student-rating"><i class="fa fa-star font-12 me-1"></i>4.9</span>

                                        </div>

                                    </div>

                                    <img src="/assets/images/c-2.png" class="comment-icon">

                                </div>

                                <p class="font-13 line-height vazir-font px-3 text-justify">
                                    من از اولین فیلمی که داشتین بدن عروسک رو پر میکردین فهمیدم که آموزش هاتون با بقیه فرق داره. همش منتظر بودم فیلم قطع بشه ولی دیدم که چقدر با حوصله تا آخر آخر فیلم گرفتین.
                                </p>

                            </div>

                        </div><!-- end comment item -->

                    </div>

                </div>

            </div>

        </div>

    </div><!-- end comment slider -->

@endsection