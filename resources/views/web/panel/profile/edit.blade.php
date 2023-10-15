<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/bootstrap.rtl.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>قالب دانشیار | پروفایل  </title>
</head>
<body>

@include('includes.header')

<div class="container">

    <div class="row">

        <div class="col-lg-3 "><!-- start right sidebar -->

            <div class="card border-0 shadow-sm bg-info my-3 p-3"><!-- start avatar box -->

                <img src="/assets/images/avatar.png" class="avatar">

                <p class="font-14 text-white text-center">آرش سبحانی عزیز سلام !</p>

            </div><!-- end avatar box -->

            <div class="list-group mb-3" ><!-- start sidebar menu -->

                <a href="profile.html" class="list-group-item list-group-item-action font-13 text-dark"> <i class="fa fa-home align-middle me-2 font-13 text-secondary"></i>پیشخوان</a>

                <a href="profile-course.html" class="list-group-item list-group-item-action font-13 text-dark"><i class="fas fa-graduation-cap align-middle me-2  text-secondary"></i>دوره های شما</a>

                <a href="profile-comments.html" class="list-group-item list-group-item-action font-13 text-dark"><i class="far fa-comment align-middle me-2 font-13  text-secondary" ></i>نظرات </a>

                <a href="profile-tickets.html" class="list-group-item list-group-item-action font-13 text-dark"><i class="fas fa-tags align-middle me-2 font-12 text-secondary"></i>تیکت ها </a>

                <a href="profile-info.html" class="list-group-item list-group-item-action font-13 text-info"><i class="fa fa-user-circle align-middle me-2 font-13  text-secondary"></i>جزئیات حساب کاربری</a>

                <a href="#" class="list-group-item list-group-item-action font-13 text-dark"><i class="fas fa-sign-out-alt align-middle me-2 font-13  text-secondary"></i> خروج</a>

            </div><!-- end sidebar menu -->

        </div><!-- end right sidebar -->

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


<footer class="bg-light"><!-- start footer -->

    <div class="container py-3">

        <div class="row">

            <div class="col-lg-4"><!-- start footer info -->

                <img src="/assets/images/footer-logo.jpg" alt="Daneshar" class="mb-2">

                <p class="line-height font-13 mb-4">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                    استفاده از طراحان گرافیک است.
                    چاپگرها و متون بلکه روزنامه و مجله در ستون و سطر آنچنان که لازم است.
                </p>

                <p class="font-13"><i class="fas fa-map-marker-alt text-muted me-2"></i>استان تهران شهر تهران - خیابان گاندی جنوبی - پلاک ۲۸</p>

                <p class="font-13"><i class="fas fa-envelope text-muted me-2"></i> info@sitename.com</p>

                <p class="font-13"><i class="fa fa-phone text-muted me-2"></i>021-12345678</p>

            </div><!-- end footer info -->

            <div class="col-lg-4 col-md-6 text-center footer-links mb-4"><!-- start footer links -->

                <span class="mt-5 pt-2 d-block">با دانشیار </span>

                <ul class="ps-0">

                    <li class="my-3"><a href="contactus.html" class="font-13 text-dark">درباره دانشیار</a></li>

                    <li class="my-3"><a href="contactus.html" class="font-13 text-dark">تماس با دانشیار</a></li>

                    <li class="my-3"><a href="contactus.html" class="font-13 text-dark">شرایط استفاده</a></li>

                    <li class="my-3"><a href="contactus.html" class="font-13 text-dark">پاسخ به پرسش‌های متداول</a></li>

                </ul>

            </div><!-- end footer links -->

            <div class="col-lg-4 col-md-6">

                <div class="row">

                    <div class="col-lg-12 d-flex justify-content-end footer-pics"><!-- start footer pics -->

                        <img src="/assets/images/footer1.png" class="footer-pic">

                        <img src="/assets/images/footer2.png" class="footer-pic">

                    </div><!-- end footer pics -->

                    <div class="col-lg-12"><!-- start share email box -->

                        <div class="input-group mt-5">

                            <input type="email" class="form-control form-control-lg" placeholder="اشتراک در خبرنامه">

                            <button type="submit" class="btn btn-warning email-btn"><i class=" fa fa-envelope"></i></button>

                        </div>

                    </div><!-- end share email box -->

                </div>

            </div>

        </div>

        <div class="row"><!-- start social media box -->

            <div class="col-md-12 text-center py-2">

                <p class="font-13 my-4"> کلیه حقوق این سایت متعلق به یاس دیزاین است .</p>

                <a href="contactus.html"><i class="fab fa-instagram social-media"></i></a>

                <a href="contactus.html"><i class="fab fa-twitter social-media"></i></a>

                <a href="contactus.html"><i class="fab fa-youtube social-media"></i></a>

                <a href="contactus.html"><i class="fab fa-telegram social-media"></i></a>

            </div>

        </div><!-- end social media box -->

        <a href="#" class="topbutton"></a><!-- bottom to top btn -->

    </div>

</footer><!-- end footer -->

<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/owl.carousel.min.js"></script>
<script src="/assets/js/countfect.min.js"></script>
<script src="/assets/js/script.js"></script>
</body>
</html>