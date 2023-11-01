<div class="container"><!-- start course box -->

    <div class="row">

        @foreach(\App\Models\Course::where('status', '<>', 'inactive')->get() as $course)

            <div class="col-lg-4 col-sm-6 "><!-- start course item -->

                <div class="card custom-card mb-3 shadow-sm">

                    <div class="sub-layer">

                        <img src="{{$course->get_cover()}}" class="img-fluid" >

                        <!-- discount percent icon -->
                        @if($course->discount_percent)
                            <div class="over-layer-discount">
                                <img src="/assets/images/discount.png" width="100px">
                            </div>
                        @endif

                        <div class="over-layer">

                            <a href="{{route('courses.show', ['course' => $course->id])}}" class="btn btn-info">مشاهده و خرید</a>

                        </div>

                    </div>

                    <div class="card-body">

                        <a href="{{route('courses.show', ['course' => $course->id])}}" class="text-dark d-block mb-2">{{$course->name}}</a>

                        <p class="font-13 text-justify line-height vazir-font">
                            {{$course->summery ?: 'برای توضیحات بیشتر کلیک کنید.'}}
                        </p>

                    </div>

                    <div class="card-footer">

                        <img src="/assets/images/hanie_heydari.png" class="team-icon">

                        <span class="font-12 vazir-font">{{$course->teacher_name}}</span>

                        <div class="float-end mt-1">

                            @if($course->status == 'not_for_sale')
                                <span class="text-danger font-12"> نامشخص </span>
                            @elseif(!empty($course->price))
                                @if(!empty($course->discount_percent))
                                    <span class="text-success m-3">{{$course->discount_percent}}<i class="fa fa-percent"></i> تخفیف </span>

                                    <del class="text-muted font-12 me-2">{{number_format($course->price)}}</del>

                                    <span class="text-success font-12">{{number_format(calculateDiscountedPrice($course->price, $course->discount_percent)) . ' تومان '}}</span>

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

    </div>

</div><!-- end course box -->

@push('styles')
    <style>
        .over-layer-discount {
            position: absolute;
            top: -8px;
            right: 75%;
            width: 100%;
            height: 100%;
            visibility: visible;
            opacity: 1;
            transition: all ease-in-out 0.2s;
        }
    </style>
@endpush