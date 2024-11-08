@extends('layouts.app')
@section('title', $article->title)

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

        @if($article->has_image)
            <div class="row">

                <div class="col-12">

                    <img src="/media/articles/{{$article->id}}/image.jpg" class="article-pic"><!-- article image -->

                </div>

            </div>
        @endif

        <div class="row"><!-- start article content-->

            <div class="col-lg-12">

                <h1 class="font-18 mt-5 mb-4">{{$article->title}}</h1>

                <div class="mb-3">

                    <span class="text-muted font-12"><i class="fa fa-pencil text-success me-2"></i>{{$article->author->name}}</span>

                    <span class="text-muted ps-3 font-12"><i class="fa fa-calendar me-2"></i>{{\Morilog\Jalali\Jalalian::fromCarbon($article->created_at)->format('%d %B %Y')}}</span>

                    <span class="text-muted ps-3 font-12"><i class="fa fa-eye text-info me-2"></i>{{$article->views}}</span>

                    <span class="text-muted ps-3 font-12">دسته بندی : عروسک سازی</span>

                </div>

                <p id="content-article">{!! $article->content !!}</p>

            </div>
        </div><!-- end article content-->

        <div class="row"><!-- start tags -->

            <div class="col-lg-12">

                <span class="font-13 vazir-font bg-light p-1 border rounded"># عروسک سازی</span>

            </div>

        </div><!-- end tags -->

    </div>


    {{--    <div class="container pt-5"><!-- start send comment -->--}}

    {{--        <p class="font-14">دیدگاه کاربران</p>--}}

    {{--        <div class="row mt-4">--}}

    {{--            <div class="col">--}}

    {{--                <input type="text" class="form-control form-control-lg" placeholder="نام و نام خانوادگی">--}}

    {{--            </div>--}}

    {{--            <div class="col">--}}

    {{--                <input type="text" class="form-control form-control-lg" placeholder="ایمیل">--}}

    {{--            </div>--}}

    {{--        </div>--}}

    {{--        <div class="row mt-3">--}}

    {{--            <div class="col-12">--}}

    {{--                <textarea  class="form-control" rows="5" placeholder="متن دیدگاه شما"></textarea>--}}

    {{--                <button type="submit" class="btn btn-lg btn-info float-end font-13 my-3">ثبت دیدگاه</button>--}}

    {{--            </div>--}}

    {{--        </div>--}}

    {{--    </div><!-- end send comment -->--}}

    {{--    <div class="container"><!-- start comment box -->--}}

    {{--        <div class="row">--}}

    {{--            <div class="col-12 bg-light shadow-sm mb-3 p-2 pb-3"><!-- start comment item -->--}}

    {{--                <div class="d-flex justify-content-between align-items-center">--}}

    {{--                    <div class="d-flex">--}}

    {{--                        <div>--}}

    {{--                            <img src="assets/images/user-1.png" class="comment-pic">--}}

    {{--                        </div>--}}

    {{--                        <div>--}}

    {{--                            <span class="font-13 d-block ms-3 mt-3">آرش سبحانی</span>--}}

    {{--                            <div class="d-flex ms-3 mt-3">--}}

    {{--                                <i class="fa fa-star me-1 font-13 text-warning"></i>--}}

    {{--                                <i class="fa fa-star me-1 font-13 text-warning"></i>--}}

    {{--                                <i class="fa fa-star me-1 font-13 text-warning"></i>--}}

    {{--                                <i class="fa fa-star me-1 font-13 text-warning"></i>--}}

    {{--                                <i class="fa fa-star me-1 font-13 text-warning"></i>--}}

    {{--                            </div>--}}

    {{--                        </div>--}}

    {{--                    </div>--}}

    {{--                    <span class="font-12 text-muted"> <i class="fa fa-calendar font-14 me-2"></i> 20 بهمن 1401 </span>--}}

    {{--                </div>--}}

    {{--                <p class="font-13 vazir-font line-height px-5 mt-3">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده--}}
    {{--                    از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای--}}
    {{--                    شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.--}}
    {{--                </p>--}}

    {{--                <div class="d-fex px-5">--}}

    {{--                    <span class="font-12 me-4"><i class="far fa-heart text-danger font-15 me-1"></i>(12)</span>--}}

    {{--                    <span class="font-12 me-4"><i class="far fa-thumbs-up text-success font-15 me-1"></i>(8)</span>--}}

    {{--                    <span class="font-12 me-4"><i class="far fa-thumbs-down text-muted font-15 me-1"></i>(0)</span>--}}

    {{--                </div>--}}

    {{--                <div class="bg-white shadow-sm mx-5 mt-3 p-3 rounded"><!-- start reply box -->--}}

    {{--                    <div class="d-flex justify-content-between align-items-center">--}}

    {{--                        <p class="font-13 text-danger">مدیر سایت</p>--}}

    {{--                        <span class="font-12 text-muted"> <i class="fa fa-calendar font-14 me-2"></i> 21 بهمن 1401 </span>--}}

    {{--                    </div>--}}

    {{--                    <p class="font-13 vazir-font line-height">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده--}}
    {{--                        از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای--}}
    {{--                        شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.--}}
    {{--                    </p>--}}

    {{--                </div><!-- end reply box -->--}}

    {{--            </div><!-- end comment item -->--}}

    {{--        </div>--}}

    {{--    </div><!-- end comment box -->--}}


    <div class="container d-flex justify-content-between mt-5 mb-4"><!-- start title-->

        <div class="title">

            <p class="font-14 ps-2"> مطالب پیشنهادی  </p>

            <p class="font-12 ps-3 text-muted"> همیشه به روز باش!</p>

        </div>

        <a href="/articles" class="title-btn align-self-start">همه مقالات<i class="fa fa-arrow-left align-middle ms-1"></i></a>

    </div><!-- end title-->


    <div class="container"><!-- start article box -->

        <div class="row">

            @foreach($suggestion_articles as $suggestion_article)
                <div class="col-lg-4 col-sm-6"><!-- start article item -->

                    <div class="card shadow-sm mb-3 article-card">

                        @if($suggestion_article->has_image)
                            <img src="/media/articles/{{$suggestion_article->id}}/image.jpg" class="img-fluid">
                        @endif

                        <div class="card-body">

                            <a href="/articles/{{$suggestion_article->id}}" class="text-dark d-block my-2"> {{$suggestion_article->title}} </a>

                            <p class="font-13 text-justify line-height vazir-font">{{$suggestion_article->abstract}}</p>

                            <span class="font-12 vazir-font"><i class="fa fa-pen font-12 text-secondary align-middlle"></i> {{$suggestion_article->author->name}} </span>

                            <a href="/articles/{{$suggestion_article->id}}" class="btn btn-info font-12 float-end">ادامه مطلب</a>

                        </div>

                    </div>

                </div><!-- end article item -->
            @endforeach

        </div>

    </div><!-- end article box -->

@endsection

@push('scripts')
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script>
        $('#content-article *, #content-article').addClass('vazir-font font-14 text-justify line-height');
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