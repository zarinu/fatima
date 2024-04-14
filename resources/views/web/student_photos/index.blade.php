@extends('layouts.app')
@section('title', 'گالری تصاویر هنرجویان')

@section('content')

    <div class="container my-3"><!-- start breadcrumb -->

        <ul class="breadcrumb shadow-sm bg-light p-2">

            <li class="breadcrumb-item"><a href="#" class="font-12 vazir-font text-secondary">صفحه اصلی</a></li>

            <li class="breadcrumb-item"><a href="#" class="ps-2 font-12 vazir-font  text-secondary"> گالری تصاویر هنرجویان </a></li>

        </ul>

    </div><!-- end breadcrumb -->

    <div><!-- start student gallery images -->

        <div class="container"><!-- start category boxes -->

            <div class="row">
                @foreach(\App\Models\StudentPhoto::orderBy('order')->get() as $student_photo)
                    <div class="col-sm-6 col-6">
                        <div class="custom-card mb-3 shadow-sm">
                            <div class="sub-layer">

                                <div class="image">
                                    <img src="{{$student_photo->photo()}}" alt="تصویر هنرجو" style="border-radius:10px" width="100%" class="img-thumbnail img-fluid">
                                </div>

                                <div class="over-layer">
                                    <button class="btn btn-outline-light">نمونه کار هنرجو</button>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div><!-- end of student gallery images -->

@endsection