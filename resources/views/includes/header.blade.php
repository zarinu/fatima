<header class="d-none d-lg-block container"><!-- start header -->

    <div class="row py-2">

        <div class="col-lg-2">
            @include('includes.logo')
        </div><!-- logo -->

        <div class="col-lg-6 d-flex align-items-center ps-5 pe-0"><!-- start search box -->

            <div class="input-group">

                <input type="search" class="form-control form-control-lg"  placeholder="چی دوست داری یاد بگیری ؟! ...">

                <button type="submit" class="btn btn-secondary"><img src="/assets/images/search.png" class="search-btn"></button>

            </div>

        </div><!-- end search box -->

        <div class="col-lg-2 d-flex align-items-center justify-content-end"><!-- start shopping bag-->

            <a href="#shopping-bag" class="position-relative me-5" data-bs-toggle="offcanvas"><img src="/assets/images/bag.png" class="shopping-bag-icon">

                <div class="count">{{ count((array) session('cart')) }}</div>
            </a>

            <div class="offcanvas offcanvas-end" tabindex="-1" data-bs-scroll="true" id="shopping-bag"><!-- start shopping bag side bar -->

                @if(session('cart'))

                    <div class="offcanvas-header mb-3"><!-- start bag header -->

                        <p class="offcanvas-title font-12">سبد خرید ({{ count((array) session('cart')) }} دوره)</p>

                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>

                    </div><!-- end bag header -->

                    <div class="offcanvas-body"><!-- start bag body -->

                        @foreach(session('cart') as $id => $details)

                            <div class="cart-item d-flex align-items-center justify-content-between"><!-- start cart item -->

                                <a href="/courses/{{$id}}"><img src="{{$details['image']}}"></a>

                                <div class="cart-item-detail">

                                    <a href="/courses/{{$id}}">{{$details['name']}}</a>

                                    @if(!empty($details['discount_percent']))
                                        <del class="font-12 text-muted mt-3">{{number_format($details['price'])}} تومان </del>
                                    @endif

                                    <p class="font-12 text-success mt-3">{{number_format($details['discounted_price'])}} تومان </p>

                                </div>

                                <a href="#" data-item-id="{{$id}}" class="delete-item"><i class="fa fa-times"></i></a>

                            </div><!-- end cart item -->

                        @endforeach

                    </div><!-- end bag body -->

                    @php $discounted_price = 0; @endphp
                    @foreach(session('cart') as $item)
                        @php $discounted_price += $item['discounted_price']; @endphp
                    @endforeach

                    <div class="d-flex justify-content-between align-items-center px-3">

                        <p class="font-13">مبلغ کل :</p>

                        <p class="font-13">{{number_format($discounted_price)}} تومان </p>

                    </div>

                    @if(auth()->check())
                        <a href="#" class="btn btn-info font-13 m-2 p-2">پرداخت</a>
                    @else
                        <a href="/login" class="btn btn-info font-13 m-2 p-2"> ادامه </a>
                    @endif

                    <a href="{{ route('cart.index') }}" class="btn btn-secondary font-13 m-2 p-2">مشاهده سبد خرید</a>

                @else

                    <div class="d-flex justify-content-between align-items-center px-3">

                        <img src="/assets/images/empty-cart.png" alt="empty cart" width="200px" class="img-fluid">

                    </div>

                    <div class="d-flex justify-content-between align-items-center px-3">

                        <p class="font-13">سبد خرید خالی است.</p>

                    </div>

                @endif

            </div><!-- end shopping bag side bar -->

        </div><!-- end shopping bag-->

        @if(auth()->check())
            <div class="col-lg-2 d-flex align-items-center justify-content-end"><!-- start profile button -->

                <a href="/panel" class="btn-panel">پنل کاربری</a>

            </div><!-- end profile button -->
        @else
            <div class="col-lg-2 d-flex align-items-center justify-content-end signup-login"><!-- start signup & login -->

                <a href="/register" class="btn-signup">ثبت نام</a>

                <a href="/login" class="btn-login">ورود</a>

            </div><!-- end signup & login -->
        @endif

    </div>

</header><!-- end header -->


<header class="d-lg-none container"><!-- start responsive header -->

    <div class="row">

        <div class="col-6 ps-0">
            @include('includes.logo')
        </div><!-- logo -->

        <div class="col-6 d-flex align-items-center justify-content-end">

            <a href="#shopping-bag-responsive" class="position-relative me-4" data-bs-toggle="offcanvas"><img src="/assets/images/bag.png" class="shopping-bag-icon"><!-- start shopping bag-->

                <div class="count">{{ count((array) session('cart')) }}</div>

            </a><!-- end shopping bag-->

            <div class="offcanvas offcanvas-end" tabindex="-1" data-bs-scroll="true" id="shopping-bag-responsive"><!-- start shopping bag side bar -->

                @if(session('cart'))

                    <div class="offcanvas-header mb-3"><!-- start bag header -->

                        <p class="offcanvas-title font-12">سبد خرید ({{ count((array) session('cart')) }} دوره)</p>

                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>

                    </div><!-- end bag header -->

                    <div class="offcanvas-body"><!-- start bag body -->

                        @foreach(session('cart') as $id => $details)

                            <div class="cart-item d-flex align-items-center justify-content-between"><!-- start cart item -->

                                <a href="/courses/{{$id}}"><img src="{{$details['image']}}"></a>

                                <div class="cart-item-detail">

                                    <a href="/courses/{{$id}}">{{$details['name']}}</a>

                                    @if(!empty($details['discount_percent']))
                                        <del class="font-12 text-muted mt-3">{{number_format($details['price'])}} تومان </del>
                                    @endif

                                    <p class="font-12 text-success mt-3">{{number_format($details['discounted_price'])}} تومان </p>

                                </div>

                                <a href="#" data-item-id="{{$id}}" class="delete-item"><i class="fa fa-times"></i></a>

                            </div><!-- end cart item -->

                        @endforeach

                    </div><!-- end bag body -->

                    @php $discounted_price = 0; @endphp
                    @foreach(session('cart') as $item)
                        @php $discounted_price += $item['discounted_price']; @endphp
                    @endforeach

                    <div class="d-flex justify-content-between align-items-center px-3 pt-3">

                        <p class="font-13">مبلغ کل :</p>

                        <p class="font-13">{{number_format($discounted_price)}} تومان </p>

                    </div>

                    @if(auth()->check())
                        <a href="#" class="btn btn-info font-13 m-2 p-2">پرداخت</a>
                    @else
                        <a href="/login" class="btn btn-info font-13 m-2 p-2"> ادامه </a>
                    @endif

                    <a href="{{ route('cart.index') }}" class="btn btn-secondary font-13 m-2 p-2">مشاهده سبد خرید</a>

                @else
                    <div class="d-flex justify-content-between align-items-center px-3 pt-3">

                        <img src="/assets/images/empty-cart.png" alt="empty cart" width="200px" class="img-fluid">

                    </div>

                    <div class="d-flex justify-content-between align-items-center px-3 pt-3">

                        <p class="font-13">سبد خرید خالی است.</p>

                    </div>
                @endif

            </div><!-- end shopping bag side bar -->

            <i class="fa fa-search header-icon me-4" data-bs-toggle="collapse" data-bs-target="#search"></i>

            <a href="#mobile-menu" data-bs-toggle="offcanvas"><i class="fa fa-bars header-icon"></i></a>

            <div class="offcanvas offcanvas-start" tabindex="-1" data-bs-scroll="true" id="mobile-menu"><!-- start responsive menu -->

                <div class="offcanvas-body">

                    @if(auth()->check())
                        <div class="d-flex align-items-center justify-content-center mt-5"><!-- start profile button -->

                            <a href="/panel" class="btn-panel">پنل کاربری</a>

                        </div><!-- end profile button -->
                    @else
                        <div class="d-flex align-items-center justify-content-center signup-login mt-5"><!-- start signup & login -->

                            <a href="/register" class="btn-signup">ثبت نام</a>

                            <a href="/login" class="btn-login">ورود</a>

                        </div><!-- end signup & login -->
                    @endif

                    <ul class="responsive-menu-level-1 ps-0 mt-5"><!-- start menu level 1 -->

                        <li class="menu-item"><a href="/">صفحه اصلی</a></li>

                        <li class="menu-item has-sub-menu"><a href="#">دوره های آموزشی</a>

                            <ul class="responsive-menu-level-2 ps-0"><!-- start menu level 2 -->

                                <li class="menu-item-2 has-sub-menu-2"><a href="#">دوره های آموزش عروسک سازی</a>

                                    <ul class="responsive-menu-level-3 ps-0"><!-- start menu level 3 -->

                                        <li class="menu-item-3"><a href="/courses">آموزش عروسک روسی</a></li>

                                        <li class="menu-item-3"><a href="/courses/2">آموزش عروسک فندق</a></li>

                                        <li class="menu-item-3"><a href="/courses">آموزش صورت برجسته</a></li>

                                    </ul><!-- end menu level 3 -->

                                </li>

                                <li class="menu-item-2"><a href="/courses/1">دوره های آموزش لباس عروسک</a></li>

                                <li class="menu-item-2"><a href="/courses">دوره های آموزش متفرقه</a></li>

                            </ul><!-- end menu level 2 -->

                        </li>

                        <li class="menu-item"><a href="/">بلاگ</a></li>

                        <li class="menu-item"><a href="/">تماس با ما</a></li>

                    </ul><!-- end menu level 1 -->

                </div>

            </div><!-- end responsive menu -->

        </div>

    </div>

    <div class="row"><!-- start search box -->

        <div class="col-12 collapse py-3" id="search">

            <div class="input-group">

                <input type="search" class="form-control form-control-lg"  placeholder="چی دوست داری یاد بگیری ؟! ...">

                <button type="submit" class="btn btn-secondary"><img src="/assets/images/search.png" class="search-btn"></button>

            </div>

        </div><!-- end search box -->

    </div><!-- end responsive search box -->

</header><!-- end header -->


<nav class="d-none d-lg-block navigation shadow-sm"><!-- start nav menu -->

    <div class="container">

        <ul class="main-menu">

            <li><a href="/">صفحه اصلی</a></li>

            <li><a href="#">دوره های آموزشی<i class="fa fa-angle-down align-middle ms-1"></i></a>

                <ul class="mega-menu row ps-0"><!-- start mega menu -->

                    <li class="col-4 mega-menu-box">

                        <ul class="ps-0">

                            <li class="menu-title"><a href="/courses"><i class="fa fa-angle-left align-middle text-warning me-1"></i>دوره های آموزش عروسک سازی</a></li>

                            <li><a href="/courses/2">آموزش عروسک فندق</a></li>

                            <li><a href="/courses">آموزش عروسک روسی</a></li>

                        </ul>

                    </li>

                    <li class="col-4 mega-menu-box">

                        <ul class="ps-0">

                            <li class="menu-title"><a href="/courses"><i class="fa fa-angle-left align-middle text-warning me-1"></i>دوره های آموزش لباس</a></li>

                            <li><a href="/courses/1">آموزش لباس عروسک</a></li>

                        </ul>

                    </li>

                </ul><!-- end mega menu -->

            </li>

            <li><a href="/">بلاگ</a></li>

            <li><a href="/">تماس با ما</a></li>

        </ul>

    </div>

</nav><!-- end nav menu -->

@push('scripts')
    <script type="text/javascript">

        $(".delete-item").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('cart.delete') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    course_id: ele.data('item-id')
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });

    </script>
@endpush