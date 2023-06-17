@extends('layouts.main')
@section('title', $lesson->title)

@section('content')
    <div class="container my-3"><!-- start breadcrumb -->

        <ul class="breadcrumb shadow-sm bg-light p-2">

            <li class="breadcrumb-item"><a href="/" class="font-12 vazir-font text-secondary">صفحه اصلی</a></li>

            <li class="breadcrumb-item"><a href="/courses" class="ps-2 font-12 vazir-font  text-secondary">دوره های عروسک سازی</a></li>

            <li class="breadcrumb-item"><a href="/courses/{{$course->id}}" class="ps-2 font-12 vazir-font  text-secondary">{{$course->name}}</a></li>

            <li class="breadcrumb-item"><a href="#" class="ps-2 font-12 vazir-font  text-secondary">{{$lesson->title}}</a></li>

        </ul>

    </div><!-- end breadcrumb -->

    <div class="container">

        <div class="row mb-1">
            <h1 class="font-18 my-3">{{$lesson->title}}</h1>
        </div>

        <div class="row">
            <video controls>
                <source src="{{$lesson->content_path}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <div class="row">
            <p class="font-14 my-3">توضیحات جلسه :</p>

            <p class="vazir-font font-13 text-justify line-height">{{$lesson->description}}</p>
        </div>

        <div class="row">
            @if($lesson->is_complete)
                <a href="/courses/{{$course->id}}/lessons/{{$lesson->id}}/toggle-complete" class="btn btn-lg btn-outline-success float-end font-13 my-3 toggle-status-complete">انجام شد</a>
            @else
                <a href="/courses/{{$course->id}}/lessons/{{$lesson->id}}/toggle-complete" class="btn btn-lg btn-outline-info float-end font-13 my-3 toggle-status-complete">علامت بزن اگر انجام شده</a>
            @endif
        </div>

        <div class="row mb-2">
            <a href="#">&rsaquo; درس بعدی: الگوی پویا</a>
        </div>

    </div>
@endsection