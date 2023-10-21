@extends('layouts.app')
@section('title', 'جستجوی دوره')

@section('content')

    <div class="container mt-4">
        @if(session('status'))
            <div class="alert alert-{{session('status')}}">
                <span class="font-15">{{ session('message') }}</span>
            </div>
        @endif
    </div>
    
    @if(session('cart'))
        <div class="container d-flex justify-content-between mt-5 mb-4"><!-- start title-->

            <div class="title">

                <p class="font-14 ps-2">سبد خرید </p>

                <p class="font-12 ps-3 text-muted">تا آخر راه کنارتون هستیم !</p>

            </div>

        </div><!-- end title-->

        <div class="container">

            <div class="row">

                <div class="col-lg-9"><!-- start cart table -->

                    <div class="table-responsive mb-3">

                        <table id="cart-table" class="table border">

                            <thead class="bg-light">

                            <tr>

                                <td>عکس</td>

                                <td>نام دوره</td>

                                <td>قیمت دوره</td>

                                <td>درصد تخفیف</td>

                                <td>قیمت کل</td>

                                <td>&nbsp</td>

                            </tr>

                            </thead>

                            <tbody>

                            @foreach(session('cart') as $id => $details)

                                <tr>

                                    <td>

                                        <div class="product-img">

                                            <img src="{{$details['image']}}">

                                        </div>

                                    </td>

                                    <td><p class="mt-2">{{$details['name']}}</p></td>

                                    <td><del class="text-muted"><span class="me-1 pt-2 d-inline-block"></span>{{number_format($details['price'])}} تومان </del></td>

                                    <td class="text-success"><span class="me-1 pt-2 d-inline-block">{{number_format($details['discount_percent'])}}</span>٪</td>

                                    <td><span class="me-1 pt-2 d-inline-block">{{number_format($details['discounted_price'])}}</span> تومان </td>

                                    <td class="bg-light border-start">

                                        <a class="delete-course" data-item-id="{{$id}}" href="#"><i class="fa fa-times pt-2 text-muted"></i></a>

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                </div><!-- end cart table -->

                @php
                    $price = 0;
                    $discounted_price = 0;
                @endphp
                @foreach(session('cart') as $item)
                    @php
                        $price += $item['price'];
                        $discounted_price += $item['discounted_price'];
                    @endphp
                @endforeach

                <div class="col-lg-3"><!-- start payment box -->

                    <div class="card shadow-sm mb-3">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">

                                <p class="font-13"> مبلغ کل ({{ count((array) session('cart')) }} دوره) :</p>

                                <p class="font-13">{{number_format($price)}} تومان </p>

                            </div>

                            <div class="d-flex justify-content-between border-bottom">

                                <p class="font-13">مجموع تخفیف :</p>

                                <p class="font-13">{{number_format($price - $discounted_price)}} تومان </p>

                            </div>

                        </div>

                        <div class="card-footer bg-white text-center border-top-0">

                            <p class="font-13">مبلغ قابل پرداخت:</p>

                            <p class="font-14">{{number_format($discounted_price)}} تومان </p>

                            @if(auth()->check())
                                <a href="#" class="btn btn-lg btn-block btn-info font-13 mb-3">پرداخت </a>
                            @else
                                <a href="/login" class="btn btn-lg btn-block btn-info font-13 mb-3">ادامه </a>
                            @endif

                        </div>

                    </div>

                </div><!-- end payment box -->

            </div>

        </div>
    @else
        <div class="container">

            <div class="row">

                <div class="col-lg-7 mx-auto text-center mt-5">

                    <img src="/assets/images/empty-cart.png" alt="empty cart" width="300px" class="img-fluid">

                    <p class="mt-3">سبد خرید شما خالی است.</p>

                    <a href="/courses" class="btn btn-lg btn-info font-13 my-3"> جستجوی دوره </a>

                </div>

            </div>

        </div>
    @endif
@endsection

@push('scripts')
    <script type="text/javascript">

        $(".delete-course").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            if(confirm("از حذف این دوره از سبد خرید اطمینان دارید؟")) {
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
            }
        });

    </script>
@endpush