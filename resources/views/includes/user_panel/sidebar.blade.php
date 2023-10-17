<div class="col-lg-3 "><!-- start right sidebar -->

    <div class="card border-0 shadow-sm bg-info my-3 p-3"><!-- start avatar box -->

        <img src="/assets/images/user-1.jpeg" class="avatar">

        <p class="font-14 text-white text-center">{{$user->name}} عزیز سلام !</p>

    </div><!-- end avatar box -->

    <div class="list-group mb-3" ><!-- start sidebar menu -->

        <a href="{{route('dashboard')}}" class="list-group-item list-group-item-action font-13 text-info"> <i class="fa fa-home align-middle me-2 font-13 text-secondary"></i>پیشخوان</a>

        <a href="{{route('courses.panel')}}" class="list-group-item list-group-item-action font-13 text-dark"><i class="fas fa-graduation-cap align-middle me-2  text-secondary"></i>دوره های شما</a>

{{--        <a href="/panel/profile" class="list-group-item list-group-item-action font-13 text-dark"><i class="fa fa-user-circle align-middle me-2 font-13  text-secondary"></i>جزئیات حساب کاربری</a>--}}

        <a href="{{route('logout')}}" class="list-group-item list-group-item-action font-13 text-dark"><i class="fas fa-sign-out-alt align-middle me-2 font-13  text-secondary"></i> خروج</a>

    </div><!-- end sidebar menu -->

</div><!-- end right sidebar -->