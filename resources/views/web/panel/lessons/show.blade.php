@extends('layouts.app')
@section('title', $lesson->title)

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

        <div class="row mb-1">
            <h1 class="font-18 my-3">{{$lesson->title}}</h1>
        </div>

        <div class="row">
            <video controls oncontextmenu="return false;" id="lesson-video">
                <source src="{{'/' . $lesson->get_url()}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        @if(!empty($lesson->description))
            <div class="row">
                <p class="font-15 my-3 text-bold">توضیحات جلسه</p>

                <div id="description">{!! $lesson->description !!}</div>
            </div>
        @endif

        <div class="row">
            @if($lesson->is_complete())
                <a href="/panel/courses/{{$course->id}}/lessons/{{$lesson->id}}/toggle-complete/0" class="btn btn-lg btn-outline-success float-end font-13 my-3 toggle-status-complete">انجام شد</a>
            @else
                <a href="/panel/courses/{{$course->id}}/lessons/{{$lesson->id}}/toggle-complete/1" class="btn btn-lg btn-outline-info float-end font-13 my-3 toggle-status-complete">علامت بزن اگر انجام شده</a>
            @endif
        </div>

        <div class="row mb-2">
            <a class="col font-14 btn btn-lg btn-info m-1 {{empty($lesson->previous_lesson_id) ? 'disabled' : ''}}" href="/panel/courses/{{$course->id}}/lessons/{{$lesson->previous_lesson_id}}">&#x21e8; درس قبلی </a>

            <a class="col font-14 btn btn-lg btn-info m-1 {{empty($lesson->next_lesson_id) ? 'disabled' : ''}}" href="/panel/courses/{{$course->id}}/lessons/{{$lesson->next_lesson_id}}"> درس بعدی &#x21e6;</a>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $('#lesson-video').attr("controlslist", "nodownload")
    </script>

    <script>
        $('#description *').addClass('vazir-font font-14 text-justify line-height text-bold');
    </script>
@endpush