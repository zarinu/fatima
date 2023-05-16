<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">@vite(['resources/css/bootstrap.rtl.css', 'resources/css/all.min.css', 'resources/css/owl.carousel.min.css', 'resources/css/owl.theme.default.min.css', 'resources/css/style.css', 'resources/css/app.css', 'resources/js/app.js'])
    <title>قالب دانشیار | صفحه اصلی</title></head>
<body>
<header class="d-none d-lg-block container"><!-- start header -->
    <div class="row py-2">
        <div class="col-lg-2"><img src="{{ Vite::asset('resources/images/logo.jpg') }}" height="66px" width="184px" alt="Daneshyar"></div>
        <!-- logo -->
        <div class="col-lg-6 d-flex align-items-center ps-5 pe-0"><!-- start search box -->
            <div class="input-group"><input type="search" class="form-control form-control-lg"
                                            placeholder="چی دوست داری یاد بگیری ؟! ...">
                <button type="submit" class="btn btn-secondary"><img
                        src="{{ Vite::asset('resources/images/search.png') }}" class="search-btn"></button>
            </div>
        </div><!-- end search box -->
        <div class="col-lg-2 d-flex align-items-center justify-content-end"><!-- start shopping bag--><a
                href="#shopping-bag" class="position-relative me-5" data-bs-toggle="offcanvas"><img
                    src="{{ Vite::asset('resources/images/bag.png') }}" class="shopping-bag-icon">
                <div class="count">2</div>
            </a>
            <div class="offcanvas offcanvas-end" tabindex="-1" data-bs-scroll="true" id="shopping-bag">
                <!-- start shopping bag side bar -->
                <div class="offcanvas-header mb-3"><!-- start bag header --><p class="offcanvas-title font-12">سبد خرید
                        (4 کالا)</p>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div><!-- end bag header -->
                <div class="offcanvas-body"><!-- start bag body -->
                    <div class="cart-item d-flex align-items-center justify-content-between"><!-- start cart item --><a
                            href="course.html"><img src="{{ Vite::asset('resources/images/flutter.png') }}"></a>
                        <div class="cart-item-detail"><a href="course.html">آموزش حرفه ای Flutter</a>
                            <p class="font-12 text-muted mt-3">320.000 تومان</p></div>
                        <a href="#" class="delete-item"><i class="fa fa-times"></i></a></div><!-- end cart item -->
                    <div class="cart-item d-flex align-items-center justify-content-between"><!-- start cart item --><a
                            href="course.html"><img src="{{ Vite::asset('resources/images/flutter.png') }}"></a>
                        <div class="cart-item-detail"><a href="course.html">آموزش حرفه ای Flutter</a>
                            <p class="font-12 text-muted mt-3">320.000 تومان</p></div>
                        <a href="#" class="delete-item"><i class="fa fa-times"></i></a></div><!-- end cart item -->
                    <div class="cart-item d-flex align-items-center justify-content-between"><!-- start cart item --><a
                            href="course.html"><img src="{{ Vite::asset('resources/images/flutter.png') }}"></a>
                        <div class="cart-item-detail"><a href="course.html">آموزش حرفه ای Flutter</a>
                            <p class="font-12 text-muted mt-3">320.000 تومان</p></div>
                        <a href="#" class="delete-item"><i class="fa fa-times"></i></a></div><!-- end cart item -->
                    <div class="cart-item d-flex align-items-center justify-content-between"><!-- start cart item --><a
                            href="course.html"><img src="{{ Vite::asset('resources/images/flutter.png') }}"></a>
                        <div class="cart-item-detail"><a href="course.html">آموزش حرفه ای Flutter</a>
                            <p class="font-12 text-muted mt-3">320.000 تومان</p></div>
                        <a href="#" class="delete-item"><i class="fa fa-times"></i></a></div><!-- end cart item -->
                </div><!-- end bag body -->
                <div class="d-flex justify-content-between align-items-center px-3"><p class="font-13">مبلغ کل :</p>
                    <p class="font-13">1,350,000 تومان</p></div>
                <a href="#" class="btn btn-info font-13 m-2 p-2">پرداخت</a><a href="cart.html"
                                                                              class="btn btn-secondary font-13 m-2 p-2">مشاهده
                    سبد خرید</a></div><!-- end shopping bag side bar --></div><!-- end shopping bag-->
        <div class="col-lg-2 d-flex align-items-center justify-content-end signup-login"><!-- satrt signup & login --><a
                href="signup.html" class="btn-signup">ثبت نام</a><a href="login.html" class="btn-login">ورود</a></div>
        <!-- end signup & login --></div>
</header><!-- end header -->
<header class="d-lg-none container"><!-- start responsive header -->
    <div class="row">
        <div class="col-6 ps-0"><img src="{{ Vite::asset('resources/images/logo.jpg') }}" height="66px" width="184px" alt="Daneshyar"></div><!-- logo -->
        <div class="col-6 d-flex align-items-center justify-content-end"><a href="#shopping-bag-responsive"
                                                                            class="position-relative me-4"
                                                                            data-bs-toggle="offcanvas"><img
                    src="{{ Vite::asset('resources/images/bag.png') }}" class="shopping-bag-icon"><!-- start shopping bag-->
                <div class="count">2</div>
            </a><!-- end shopping bag-->
            <div class="offcanvas offcanvas-end" tabindex="-1" data-bs-scroll="true" id="shopping-bag-responsive">
                <!-- start shopping bag side bar -->
                <div class="offcanvas-header mb-3"><!-- start bag header --><p class="offcanvas-title font-12">سبد خرید
                        (4 کالا)</p>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div><!-- end bag header -->
                <div class="offcanvas-body"><!-- start bag body -->
                    <div class="cart-item d-flex align-items-center justify-content-between"><!-- start cart item --><a
                            href="course.html"><img src="{{ Vite::asset('resources/images/flutter.png') }}"></a>
                        <div class="cart-item-detail"><a href="contactus.html">آموزش حرفه ای Flutter</a>
                            <p class="font-12 text-muted mt-3">320.000 تومان</p></div>
                        <a href="#" class="delete-item"><i class="fa fa-times"></i></a></div><!-- end cart item -->
                    <div class="cart-item d-flex align-items-center justify-content-between"><!-- start cart item --><a
                            href="course.html"><img src="{{ Vite::asset('resources/images/flutter.png') }}"></a>
                        <div class="cart-item-detail"><a href="course.html">آموزش حرفه ای Flutter</a>
                            <p class="font-12 text-muted mt-3">320.000 تومان</p></div>
                        <a href="#" class="delete-item"><i class="fa fa-times"></i></a></div><!-- end cart item -->
                    <div class="cart-item d-flex align-items-center justify-content-between"><!-- start cart item --><a
                            href="course.html"><img src="{{ Vite::asset('resources/images/flutter.png') }}"></a>
                        <div class="cart-item-detail"><a href="course.html">آموزش حرفه ای Flutter</a>
                            <p class="font-12 text-muted mt-3">320.000 تومان</p></div>
                        <a href="#" class="delete-item"><i class="fa fa-times"></i></a></div><!-- end cart item -->
                    <div class="cart-item d-flex align-items-center justify-content-between"><!-- start cart item --><a
                            href="course.html"><img src="{{ Vite::asset('resources/images/flutter.png') }}"></a>
                        <div class="cart-item-detail"><a href="course.html">آموزش حرفه ای Flutter</a>
                            <p class="font-12 text-muted mt-3">320.000 تومان</p></div>
                        <a href="#" class="delete-item"><i class="fa fa-times"></i></a></div><!-- end cart item -->
                </div><!-- end bag body -->
                <div class="d-flex justify-content-between align-items-center px-3 pt-3"><p class="font-13">مبلغ کل
                        :</p>
                    <p class="font-13">1,350,000 تومان</p></div>
                <a href="#" class="btn btn-info font-13 m-2 p-2">پرداخت</a><a href="cart"
                                                                              class="btn btn-secondary font-13 m-2 p-2">مشاهده
                    سبد خرید</a></div><!-- end shopping bag side bar --><i class="fa fa-search header-icon me-4"
                                                                           data-bs-toggle="collapse"
                                                                           data-bs-target="#search"></i><a
                href="#mobile-menu" data-bs-toggle="offcanvas"><i class="fa fa-bars header-icon"></i></a>
            <div class="offcanvas offcanvas-start" tabindex="-1" data-bs-scroll="true" id="mobile-menu">
                <!-- start responsive menu -->
                <div class="offcanvas-body">
                    <div class="d-flex align-items-center justify-content-center signup-login mt-5">
                        <!-- start signup & login --><a href="signup.html" class="btn-signup">ثبت نام</a><a
                            href="login.html" class="btn-login">ورود</a></div><!-- end signup & login -->
                    <ul class="responsive-menu-level-1 ps-0 mt-5"><!-- start menu level 1 -->
                        <li class="menu-item"><a href="#">صفحه اصلی</a></li>
                        <li class="menu-item has-sub-menu"><a href="#">دوره های آموزشی</a>
                            <ul class="responsive-menu-level-2 ps-0"><!-- start menu level 2 -->
                                <li class="menu-item-2 has-sub-menu-2"><a href="#">دوره های آموزش برنامه نویسی</a>
                                    <ul class="responsive-menu-level-3 ps-0"><!-- start menu level 3 -->
                                        <li class="menu-item-3"><a href="course.html">آموزش برنامه نویسی</a></li>
                                        <li class="menu-item-3"><a href="course.html">آموزش برنامه نویسی</a></li>
                                        <li class="menu-item-3"><a href="course.html">آموزش برنامه نویسی</a></li>
                                    </ul><!-- end menu level 3 --></li>
                                <li class="menu-item-2"><a href="category.html">دوره های آموزش برنامه نویسی</a></li>
                                <li class="menu-item-2"><a href="category.html">دوره های آموزش برنامه نویسی</a></li>
                            </ul><!-- end menu level 2 --></li>
                        <li class="menu-item has-sub-menu"><a href="#">صفحات </a>
                            <ul class="responsive-menu-level-2 ps-0"><!-- start menu level 2 -->
                                <li class="menu-item-2"><a href="signup.html">ثبت نام</a></li>
                                <li class="menu-item-2"><a href="login.html">ورود</a></li>
                                <li class="menu-item-2"><a href="remember.html">فراموشی رمز عبور</a></li>
                                <li class="menu-item-2"><a href="profile.html">پروفایل کاربر</a></li>
                                <li class="menu-item-2"><a href="teach.html">درخواست تدریس</a></li>
                                <li class="menu-item-2"><a href="cart.html">سبد خرید </a></li>
                                <li class="menu-item-2"><a href="404.html">صفحه 404</a></li>
                            </ul><!-- end menu level 2 --></li>
                        <li class="menu-item"><a href="blog.html">بلاگ</a></li>
                        <li class="menu-item"><a href="contactus.html">تماس با ما</a></li>
                    </ul><!-- end menu level 1 --></div>
            </div><!-- end responsive menu --></div>
    </div>
    <div class="row"><!-- start search box -->
        <div class="col-12 collapse py-3" id="search">
            <div class="input-group"><input type="search" class="form-control form-control-lg"
                                            placeholder="چی دوست داری یاد بگیری ؟! ...">
                <button type="submit" class="btn btn-secondary"><img src="{{ Vite::asset('resources/images/search.png') }}" class="search-btn">
                </button>
            </div>
        </div><!-- end search box --></div><!-- end responsive search box --></header><!-- end header -->
<nav class="d-none d-lg-block navigation shadow-sm"><!-- start nav menu -->
    <div class="container">
        <ul class="main-menu">
            <li><a href="#">صفحه اصلی</a></li>
            <li><a href="#">دوره های آموزشی<i class="fa fa-angle-down align-middle ms-1"></i></a>
                <ul class="mega-menu row ps-0"><!-- start mega menu -->
                    <li class="col-4 mega-menu-box">
                        <ul class="ps-0">
                            <li class="menu-title"><a href="category.html"><i
                                        class="fa fa-angle-left align-middle text-warning me-1"></i>دوره های آموزش
                                    برنامه نویسی</a></li>
                            <li><a href="course.html">آموزش برنامه نویسی</a></li>
                            <li><a href="course.html">آموزش برنامه نویسی</a></li>
                            <li><a href="course.html">آموزش برنامه نویسی</a></li>
                            <li><a href="course.html">آموزش برنامه نویسی</a></li>
                        </ul>
                    </li>
                    <li class="col-4 mega-menu-box">
                        <ul class="ps-0">
                            <li class="menu-title"><a href="category.html"><i
                                        class="fa fa-angle-left align-middle text-warning me-1"></i>دوره های آموزش
                                    برنامه نویسی</a></li>
                            <li><a href="course.html">آموزش برنامه نویسی</a></li>
                            <li><a href="course.html">آموزش برنامه نویسی</a></li>
                            <li><a href="course.html">آموزش برنامه نویسی</a></li>
                            <li><a href="course.html">آموزش برنامه نویسی</a></li>
                        </ul>
                    </li>
                    <li class="col-4 mega-menu-box">
                        <ul class="ps-0">
                            <li class="menu-title"><a href="category.html"><i
                                        class="fa fa-angle-left align-middle text-warning me-1"></i>دوره های آموزش
                                    برنامه نویسی</a></li>
                            <li><a href="course.html">آموزش برنامه نویسی</a></li>
                            <li><a href="course.html">آموزش برنامه نویسی</a></li>
                            <li><a href="course.html">آموزش برنامه نویسی</a></li>
                            <li><a href="course.html">آموزش برنامه نویسی</a></li>
                        </ul>
                    </li>
                </ul><!-- end mega menu --></li>
            <li><a href="#">صفحات<i class="fa fa-angle-down align-middle ms-1"></i></a>
                <ul class="sub-menu"><!-- start sub menu -->
                    <li><a href="signup.html">ثبت نام</a></li>
                    <li><a href="login.html">ورود</a></li>
                    <li><a href="remember.html">فراموشی رمز عبور</a></li>
                    <li><a href="profile.html">پروفایل کاربر</a></li>
                    <li><a href="teach.html">درخواست تدریس</a></li>
                    <li><a href="cart.html">سبد خرید </a></li>
                    <li><a href="404.html">صفحه 404</a></li>
                </ul><!-- end sub menu --></li>
            <li><a href="blog.html">بلاگ</a></li>
            <li><a href="contactus.html">تماس با ما</a></li>
        </ul>
    </div>
</nav><!-- end nav menu -->
<div class="d-none d-sm-block banner-3"><!-- start banner -->
    <div class="container">
        <div class="row">
            <div class="col-lg-6"><h1>داستان عروسک‌ساز شدنت از اینجا شروع میشه!</h1><h6>یادگیری عروسک‌سازی آرزو
                    نیست، فقط نیاز هست، تلاش و تمرین داشته باشید، بقیه‌اش با من</h6><a href="category.html"
                                                                                            class="btn btn-custom-info">شروع
                    یادگیری عروسک سازی <i class="fa fa-arrow-left align-middle mt-1"></i></a>
                <div class="row pb-3"><!-- start banner icons -->
                    <div class="col-6 pt-4"><i class="fas fa-chalkboard-teacher" id="chalkboard-icon"></i><span>بیش از 80 دوره آموزشی</span>
                    </div>
                    <div class="col-6 pt-4"><i class="fas fa-wallet" id="wallet-icon"></i><span>ضمانت بازگشت وجه</span>
                    </div>
                    <div class="col-6 pt-4"><i class="fas fa-pen"
                                               id="pen-icon"></i><span>یادگیری با تمرین و آزمون</span></div>
                    <div class="col-6 pt-4"><i class="fas fa-phone" id="phone-icon"></i><span>پشتیبانی ۲۴ساعته</span>
                    </div>
                </div><!-- end banner icons --></div>
            <div class="col-lg-6"><img src="{{ Vite::asset('resources/images/Untitled.jpeg') }}" height="652px" width="673px" class="img-fluid"></div>
        </div>
    </div>
</div><!-- end banner -->
<div class="container"><!-- start category boxes -->
    <div class="row pt-5">
        <div class="col-md-3 col-6 mb-3"><a href="category.html"><img src="{{ Vite::asset('resources/images/graphics.png') }}"
                                                                      class="img-fluid rounded"></a></div>
        <div class="col-md-3 col-6 mb-3"><a href="category.html"><img src="{{ Vite::asset('resources/images/footage.png') }}"
                                                                      class="img-fluid rounded"></a></div>
        <div class="col-md-3 col-6 mb-3"><a href="category.html"><img src="{{ Vite::asset('resources/images/sound.png') }}"
                                                                      class="img-fluid rounded"></a></div>
        <div class="col-md-3 col-6 mb-3"><a href="category.html"><img src="{{ Vite::asset('resources/images/premiere.png') }}"
                                                                      class="img-fluid rounded"></a></div>
    </div>
</div><!-- end category boxes -->
<div class="container d-flex justify-content-between mt-5 mb-4"><!-- start title-->
    <div class="title"><p class="font-14 ps-2">جدیدترین دوره های آموزشی</p>
        <p class="font-12 ps-3 text-muted">سکوی پرتاپ شما به سمت موفقیت</p></div>
    <a href="category.html" class="title-btn align-self-start">همه دوره ها <i class="fa fa-arrow-left align-middle"></i></a>
</div><!-- end title-->
<div class="container"><!-- start course box -->
    <div class="row">
        <div class="col-lg-4 col-sm-6 "><!-- start course item -->
            <div class="card custom-card mb-3 shadow-sm">
                <div class="sub-layer"><img src="{{ Vite::asset('resources/images/html.jpg') }}" class="img-fluid">
                    <div class="over-layer"><a href="course(demo-two).html" class="btn btn-info">مشاهده و خرید</a></div>
                </div>
                <div class="card-body"><a href="course(demo-two).html" class="text-dark d-block mb-2">آموزش HTML</a>
                    <p class="font-13 text-justify line-height vazir-font">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                        از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                        سطرآنچنان که لازم است.</p></div>
                <div class="card-footer"><img src="{{ Vite::asset('resources/images/team_2.jpg') }}" class="team-icon"><span
                        class="font-12 vazir-font">علی نوروزی</span>
                    <div class="float-end mt-1"><span class="text-success font-12">رایگان !</span></div>
                </div>
            </div>
        </div><!-- end course item -->
        <div class="col-lg-4 col-sm-6"><!-- start course item -->
            <div class="card custom-card mb-3 shadow-sm">
                <div class="sub-layer"><img src="{{ Vite::asset('resources/images/flutter.png') }}" class="img-fluid">
                    <div class="over-layer"><a href="course(demo-two).html" class="btn btn-info">مشاهده و خرید</a></div>
                </div>
                <div class="card-body"><a href="course(demo-two).html" class="text-dark d-block mb-2"> آموزش حرفه ای
                        Flutter</a>
                    <p class="font-13 text-justify line-height vazir-font">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                        از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                        سطرآنچنان که لازم است.</p></div>
                <div class="card-footer"><img src="{{ Vite::asset('resources/images/team_4.jpg') }}" class="team-icon"><span
                        class="font-12 vazir-font">سارا رضایی</span>
                    <div class="float-end mt-1">
                        <del class="text-muted font-12 me-2">320.000 تومان</del>
                        <span class="text-success font-12">200.000 تومان</span></div>
                </div>
            </div>
        </div><!-- end course item -->
        <div class="col-lg-4 col-sm-6"><!-- start course item -->
            <div class="card custom-card mb-3 shadow-sm">
                <div class="sub-layer"><img src="{{ Vite::asset('resources/images/js.png') }}" class="img-fluid">
                    <div class="over-layer"><a href="course(demo-two).html" class="btn btn-info">مشاهده و خرید</a></div>
                </div>
                <div class="card-body"><a href="course(demo-two).html" class="text-dark d-block mb-2">آموزش پیشرفته جاوا
                        اسکریپت</a>
                    <p class="font-13 text-justify line-height vazir-font">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                        از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                        سطرآنچنان که لازم است.</p></div>
                <div class="card-footer"><img src="{{ Vite::asset('resources/images/team_2.jpg') }}" class="team-icon"><span
                        class="font-12 vazir-font">علی نوروزی</span>
                    <div class="float-end mt-1"><span class="text-success font-12">400.000 تومان</span></div>
                </div>
            </div>
        </div><!-- end course item -->
        <div class="col-lg-4 col-sm-6"><!-- start course item -->
            <div class="card custom-card mb-3 shadow-sm">
                <div class="sub-layer"><img src="{{ Vite::asset('resources/images/laravel.jpg') }}" class="img-fluid">
                    <div class="over-layer"><a href="course(demo-two).html" class="btn btn-info">مشاهده و خرید</a></div>
                </div>
                <div class="card-body"><a href="course(demo-two).html" class="text-dark d-block mb-2">ساخت فروشگاه با
                        لاراول</a>
                    <p class="font-13 text-justify line-height vazir-font">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                        از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                        سطرآنچنان که لازم است.</p></div>
                <div class="card-footer"><img src="{{ Vite::asset('resources/images/team_3.jpg') }}" class="team-icon"><span
                        class="font-12 vazir-font">مریم اکبری</span>
                    <div class="float-end mt-1"><span class="text-success font-12">350.000 تومان</span></div>
                </div>
            </div>
        </div><!-- end course item -->
        <div class="col-lg-4 col-sm-6"><!-- start course item -->
            <div class="card custom-card mb-3 shadow-sm">
                <div class="sub-layer"><img src="{{ Vite::asset('resources/images/nodejs.png') }}" class="img-fluid">
                    <div class="over-layer"><a href="course(demo-two).html" class="btn btn-info">مشاهده و خرید</a></div>
                </div>
                <div class="card-body"><a href="course(demo-two).html" class="text-dark d-block mb-2">آموزش Nodejs</a>
                    <p class="font-13 text-justify line-height vazir-font">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                        از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                        سطرآنچنان که لازم است.</p></div>
                <div class="card-footer"><img src="{{ Vite::asset('resources/images/team_2.jpg') }}" class="team-icon"><span
                        class="font-12 vazir-font">علی نوروزی</span>
                    <div class="float-end mt-1">
                        <del class="text-muted font-12 me-2">450.000 تومان</del>
                        <span class="text-success font-12">380.000 تومان</span></div>
                </div>
            </div>
        </div><!-- end course item -->
        <div class="col-lg-4 col-sm-6"><!-- start course item -->
            <div class="card custom-card mb-3 shadow-sm">
                <div class="sub-layer"><img src="{{ Vite::asset('resources/images/TypeScript.jpg') }}" class="img-fluid">
                    <div class="over-layer"><a href="course(demo-two).html" class="btn btn-info">مشاهده و خرید</a></div>
                </div>
                <div class="card-body"><a href="course(demo-two).html" class="text-dark d-block mb-2">آموزش
                        TypeScript</a>
                    <p class="font-13 text-justify line-height vazir-font">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                        از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                        سطرآنچنان که لازم است.</p></div>
                <div class="card-footer"><img src="{{ Vite::asset('resources/images/team_4.jpg') }}" class="team-icon"><span
                        class="font-12 vazir-font">سارا رضایی</span>
                    <div class="float-end mt-1"><span class="text-success font-12">270.000 تومان</span></div>
                </div>
            </div>
        </div><!-- end course item --></div>
</div><!-- end course box -->
<div class="container">
    <div class="row px-3 my-5">
        <div class="col-lg-5 shadow rounded mb-3">
            <div class="title my-4"><!-- start title--><p class="font-14 ps-2">درخواست مشاوره رایگان</p>
                <p class="font-12 ps-3 text-muted">فرصت رو از دست نده!</p></div> <!-- end title-->
            <form><!-- start contact form -->
                <div class="mb-3"><input type="text" class="form-control form-control-lg"
                                         placeholder="نام و نام خانوادگی "></div>
                <div class="mb-3"><input type="email" class="form-control form-control-lg" placeholder="ایمیل"></div>
                <div class="mb-4"><input type="tel" class="form-control form-control-lg" placeholder="شماره تلفن"></div>
                <input type="submit" value="ثبت درخواست مشاوره" class="btn btn-info btn-lg font-13 mb-4"></form>
            <!-- end contact form --></div>
        <div class="col-lg-7 ps-3"><img src="{{ Vite::asset('resources/images/banner2.jpg') }}" class="img-fluid"></div>
    </div>
</div>
<div class="container d-flex justify-content-between mt-5 mb-3"><!-- start title-->
    <div class="title"><p class="font-14 ps-2">عضو ویژه شوید </p>
        <p class="font-12 ps-3 text-muted">با تهیه اشتراک ویژه به تمام آموزش های ویژه سایت دسترسی دارید!</p></div>
</div><!-- end title-->
<div class="container"><!-- start price plans -->
    <div class="row">
        <div class="col-lg-4 col-sm-6"><!-- start plan item -->
            <div class="card custom-card-signup shadow-sm card-1">
                <div class="circle"><h5>اشتراک یکماهه</h5>
                    <p class="text-white">120.000 تومان</p></div>
                <div class="card-body"><p class="font-14 line-height">شما می توانید به مدت یک ماه به دوره های ویژه سایت
                        دسترسی داشته باشید.</p>
                    <p class="font-13 text-secondary"><i class="fa fa-check align-middle me-1 text-secondary"></i>دسترسی
                        به تمام آموزش های ویژه سایت</p>
                    <p class="font-13 text-secondary"><i class="fa fa-check align-middle me-1 text-secondary"></i>هزینه
                        کم و دسترسی کامل</p>
                    <div class="w-100 text-center"><a href="signup.html"
                                                      class="btn btn-sm btn-outline-secondary px-3 mt-2"> ثبت نام <i
                                class="fa fa-arrow-left align-middle"></i></a></div>
                </div>
            </div>
        </div><!-- end plan item -->
        <div class="col-lg-4 col-sm-6"><!-- start plan item -->
            <div class="card custom-card-signup shadow-sm card-2">
                <div class="circle"><h5>اشتراک 3 ماهه</h5>
                    <p class="text-white">300.000 تومان</p></div>
                <div class="card-body"><p class="font-14 line-height">شما می توانید به مدت 3 ماه به دوره های ویژه سایت
                        دسترسی داشته باشید.</p>
                    <p class="font-13  text-secondary"><i class="fa fa-check align-middle me-1 text-secondary"></i>دسترسی
                        به تمام آموزش های ویژه سایت</p>
                    <p class="font-13  text-secondary"><i class="fa fa-check align-middle me-1 text-secondary"></i>سه
                        روز مهلت تست رایگان !</p>
                    <div class="w-100 text-center"><a href="signup.html"
                                                      class="btn btn-sm btn-outline-warning px-3 mt-2" id="contact2">
                            ثبت نام <i class="fa fa-arrow-left align-middle"></i></a></div>
                </div>
            </div>
        </div><!-- end plan item -->
        <div class="col-lg-4 col-sm-6"><!-- start plan item -->
            <div class="card custom-card-signup shadow-sm card-3">
                <div class="circle"><h5>اشتراک یکساله</h5>
                    <p class="text-white">700.000 تومان</p></div>
                <div class="card-body"><p class="font-14 line-height">شما می توانید به مدت یک سال به دوره های ویژه سایت
                        دسترسی داشته باشید.</p>
                    <p class="font-13 text-secondary"><i class="fa fa-check align-middle me-1 text-secondary"></i>دسترسی
                        به تمام آموزش های ویژه سایت</p>
                    <p class="font-13 text-secondary"><i class="fa fa-check align-middle me-1 text-secondary"></i>محبوب
                        و مقرون به صرفه</p>
                    <div class="w-100 text-center"><a href="signup.html"
                                                      class="btn btn-sm btn-outline-primary px-3 mt-2" id="contact3">
                            ثبت نام <i class="fa fa-arrow-left align-middle"></i></a></div>
                </div>
            </div>
        </div><!-- end plan item --></div>
</div><!-- end price plans -->
<div class="team-box"><!-- start comment slider -->
    <div class="container d-flex justify-content-between"><!-- start title-->
        <div class="title mt-5 mb-3"><p class="font-14 ps-2">دستاورد های ما</p>
            <p class="font-12 ps-3 text-muted">موفقیت شما با ما !</p></div>
    </div><!-- end title-->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel owl-theme owl-rtl">
                    <div class="item"><!-- start comment item -->
                        <div class="card border-0 bg-white p-3 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex">
                                    <div><img src="{{ Vite::asset('resources/images/user-1.png') }}" class="comment-pic"></div>
                                    <div><span class="font-13 d-block ms-2">آرش سبحانی</span><span
                                            class="font-12 d-block ms-2 text-muted mt-1">برنامه نویس گوگل</span><span
                                            class="student-rating"><i class="fa fa-star font-12 me-1"></i>4.9</span>
                                    </div>
                                </div>
                                <img src="{{ Vite::asset('resources/images/c-1.png') }}" class="comment-icon"></div>
                            <p class="font-13 line-height vazir-font px-3 text-justify">لورم ایپسوم متن ساختگی با تولید
                                سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه
                                و مجله در ستون و سطرآنچنان که لازم است.</p></div>
                    </div><!-- end comment item -->
                    <div class="item"><!-- start comment item -->
                        <div class="card border-0 bg-white p-3 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex">
                                    <div><img src="{{ Vite::asset('resources/images/user-2.jpg') }}" class="comment-pic"></div>
                                    <div><span class="font-13 d-block ms-2">زهرا حسینی</span><span
                                            class="font-12 d-block ms-2 text-muted mt-1">مدیر مایکروسافت</span><span
                                            class="student-rating"><i class="fa fa-star font-12 me-1"></i>4.5</span>
                                    </div>
                                </div>
                                <img src="{{ Vite::asset('resources/images/c-2.png') }}" class="comment-icon"></div>
                            <p class="font-13 line-height vazir-font px-3 text-justify">لورم ایپسوم متن ساختگی با تولید
                                سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه
                                و مجله در ستون و سطرآنچنان که لازم است.</p></div>
                    </div><!-- end comment item -->
                    <div class="item"><!-- start comment item -->
                        <div class="card border-0 bg-white p-3 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex">
                                    <div><img src="{{ Vite::asset('resources/images/user-3.jpg') }}" class="comment-pic"></div>
                                    <div><span class="font-13 d-block ms-2">رضاعظیمی</span><span
                                            class="font-12 d-block ms-2 text-muted mt-1">مدیر لینکدین</span><span
                                            class="student-rating"><i class="fa fa-star font-12 me-1"></i>4.3</span>
                                    </div>
                                </div>
                                <img src="{{ Vite::asset('resources/images/c-3.png') }}" class="comment-icon"></div>
                            <p class="font-13 line-height vazir-font px-3 text-justify">لورم ایپسوم متن ساختگی با تولید
                                سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه
                                و مجله در ستون و سطرآنچنان که لازم است.</p></div>
                    </div><!-- end comment item -->
                    <div class="item"><!-- start comment item -->
                        <div class="card border-0 bg-white p-3 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex">
                                    <div><img src="{{ Vite::asset('resources/images/user-1.png') }}" class="comment-pic"></div>
                                    <div><span class="font-13 d-block ms-2">آرش سبحانی</span><span
                                            class="font-12 d-block ms-2 text-muted mt-1">برنامه نویس گوگل</span><span
                                            class="student-rating"><i class="fa fa-star font-12 me-1"></i>4.9</span>
                                    </div>
                                </div>
                                <img src="{{ Vite::asset('resources/images/c-1.png') }}" class="comment-icon"></div>
                            <p class="font-13 line-height vazir-font px-3 text-justify">لورم ایپسوم متن ساختگی با تولید
                                سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه
                                و مجله در ستون و سطرآنچنان که لازم است.</p></div>
                    </div><!-- end comment item --></div>
            </div>
        </div>
    </div>
</div><!-- end comment slider -->
<div class="container d-flex justify-content-between mt-5 mb-4"><!-- start title-->
    <div class="title"><p class="font-14 ps-2"> مقالات تخصصی </p>
        <p class="font-12 ps-3 text-muted"> همیشه به روز باش!</p></div>
    <a href="blog.html" class="title-btn align-self-start">همه مقالات<i class="fa fa-arrow-left align-middle ms-1"></i></a>
</div><!-- end title-->
<div class="container"><!-- start article box -->
    <div class="row">
        <div class="col-lg-4 col-sm-6"><!-- start article item -->
            <div class="card shadow-sm mb-3 article-card"><img src="{{ Vite::asset('resources/images/article1.jpg') }}" class="img-fluid">
                <div class="card-body"><a href="article.html" class="text-dark d-block my-2">چگونه مطالعه آنلاین را شروع
                        کنیم ؟ </a>
                    <p class="font-13 text-justify line-height vazir-font">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                        از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                        سطرآنچنان که لازم است.</p><span class="font-12 vazir-font"><i
                            class="fa fa-pen font-12 text-secondary align-middlle"></i> علی نوروزی</span><a
                        href="article.html" class="btn btn-info font-12 float-end">ادامه مطلب</a></div>
            </div>
        </div><!-- end article item -->
        <div class="col-lg-4 col-sm-6"><!-- start article item -->
            <div class="card shadow-sm mb-3 article-card"><img src="{{ Vite::asset('resources/images/article2.jpg') }}" class="img-fluid">
                <div class="card-body"><a href="article.html" class="text-dark d-block my-2">بهترین زمان ارسال پست در
                        اینستاگرام</a>
                    <p class="font-13 text-justify line-height vazir-font">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                        از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                        سطرآنچنان که لازم است.</p><span class="font-12 vazir-font"><i
                            class="fa fa-pen font-12 text-secondary align-middlle"></i> علی نوروزی</span><a
                        href="article.html" class="btn btn-info font-12 float-end">ادامه مطلب</a></div>
            </div>
        </div><!-- end article item -->
        <div class="col-lg-4 col-sm-6"><!-- start article item -->
            <div class="card shadow-sm mb-3 article-card"><img src="{{ Vite::asset('resources/images/article3.jpg') }}" class="img-fluid">
                <div class="card-body"><a href="article.html" class="text-dark d-block my-2">تله های خطرناک در
                        سخنرانی</a>
                    <p class="font-13 text-justify line-height vazir-font">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                        از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                        سطرآنچنان که لازم است.</p><span class="font-12 vazir-font"><i
                            class="fa fa-pen font-12 text-secondary align-middlle"></i> علی نوروزی</span><a
                        href="article.html" class="btn btn-info font-12 float-end">ادامه مطلب</a></div>
            </div>
        </div><!-- end article item --></div>
</div><!-- end article box -->
<footer class="bg-light"><!-- start footer -->
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-4"><!-- start footer info --><img src="{{ Vite::asset('resources/images/footer-logo.jpg') }}" alt="Daneshar"
                                                                 class="mb-2">
                <p class="line-height font-13 mb-4">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                    استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطر آنچنان که لازم
                    است.</p>
                <p class="font-13"><i class="fas fa-map-marker-alt text-muted me-2"></i>استان تهران شهر تهران - خیابان
                    گاندی جنوبی - پلاک ۲۸</p>
                <p class="font-13"><i class="fas fa-envelope text-muted me-2"></i> info@sitename.com</p>
                <p class="font-13"><i class="fa fa-phone text-muted me-2"></i>021-12345678</p></div>
            <!-- end footer info -->
            <div class="col-lg-4 col-md-6 text-center footer-links mb-4"><!-- start footer links --><span
                    class="mt-5 pt-2 d-block">با دانشیار </span>
                <ul class="ps-0">
                    <li class="my-3"><a href="contactus.html" class="font-13 text-dark">درباره دانشیار</a></li>
                    <li class="my-3"><a href="contactus.html" class="font-13 text-dark">تماس با دانشیار</a></li>
                    <li class="my-3"><a href="contactus.html" class="font-13 text-dark">شرایط استفاده</a></li>
                    <li class="my-3"><a href="contactus.html" class="font-13 text-dark">پاسخ به پرسش‌های متداول</a></li>
                </ul>
            </div><!-- end footer links -->
            <div class="col-lg-4 col-md-6">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-end footer-pics"><!-- start footer pics --><img
                            src="{{ Vite::asset('resources/images/footer1.png') }}" class="footer-pic"><img src="{{ Vite::asset('resources/images/footer2.png') }}"
                                                                                    class="footer-pic"></div>
                    <!-- end footer pics -->
                    <div class="col-lg-12"><!-- start share email box -->
                        <div class="input-group mt-5"><input type="email" class="form-control form-control-lg"
                                                             placeholder=" اشتراک در خبرنامه ">
                            <button type="submit" class="btn btn-warning email-btn"><i class=" fa fa-envelope"></i>
                            </button>
                        </div>
                    </div><!-- end share email box --></div>
            </div>
        </div>
        <div class="row"><!-- start social media box -->
            <div class="col-md-12 text-center py-2"><p class="font-13 my-4"> کلیه حقوق این سایت متعلق به یاس دیزاین است
                    .</p><a href="#"><i class="fab fa-instagram social-media"></i></a><a href="#"><i
                        class="fab fa-twitter social-media"></i></a><a href="#"><i
                        class="fab fa-youtube social-media"></i></a><a href="#"><i
                        class="fab fa-telegram social-media"></i></a></div>
        </div><!-- end social media box --><a href="#" class="topbutton"></a><!-- bottom to top btn --></div>
</footer><!-- end footer -->
<script src="{{ Vite::asset('resources/js/jquery.min.js') }}"></script>
<script src="{{ Vite::asset('resources/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ Vite::asset('resources/js/owl.carousel.min.js') }}"></script>
<script src="{{ Vite::asset('resources/js/script.js') }}"></script>
</body>
</html>
