@extends('layouts.app')
@section('title', 'دوره های من')

@section('content')

    <div class="container">

        <div class="row">

            @include('includes.user_panel.sidebar')

            <div class="col-lg-9">

                <div class="card my-3 p-3 shadow-sm">

                    <p class="font-14">دوره های شما :</p>

                    <div class="row">

                        @foreach($courses as $course)

                            <div class="col-lg-12 col-md-6 mb-3"><!-- start course item -->

                                <div class="card p-2">

                                    <div class="row profile-course-box">

                                        <div class="col-lg-4">

                                            <img src="{{$course->get_cover()}}" class="img-fluid ">

                                        </div>

                                        <div class="col-lg-8">

                                            <a href="{{route('courses.show', ['course' => $course->id])}}" class="my-3 d-block font-14 text-dark">{{$course->name}}</a>

                                            <p class="font-13 line-height text-justify">{{$course->description}}</p>

                                            <button type="button" class="btn btn-info font-13 float-end" data-bs-toggle="collapse" data-bs-target="#download1">مشاهده لینک دانلود</button>

                                        </div>

                                        <div class="mt-5 collapse" id="download1" >

                                            <table class="table table-borderless text-right font-13">

                                                @foreach($course->chapters as $chapter)
                                                    <tr>
                                                        <div class="d-flex align-items-center justify-content-between bg-light rounded shadow-sm mb-3 p-3"><!-- start course list item -->

                                                            <div class="d-flex align-items-center">

                                                                @if($chapter->order%2 == 0)
                                                                    <i class="fa fa-check lock-icon"></i>
                                                                @else
                                                                    <i class="fa fa-check play-icon"></i>
                                                                @endif

                                                                <p class="font-13 ms-2 vazir-font mt-3">{{$chapter->name}}</p>

                                                            </div>

                                                            <a href="#"><i class="fa fa-download text-muted"></i></a>

                                                        </div><!-- end course list item -->

                                                        <table class="table table-borderless text-right font-13">
                                                        @foreach($chapter->lessons as $lesson)
                                                            <tr>

                                                                <td><a href="{{route('lessons.show', ['course' => $course->id, 'lesson' => $lesson->id])}}">{{$lesson->title}}</a></td>

                                                                <td><a href="{{route('lessons.download', ['course' => $course->id, 'lesson' => $lesson->id])}}" class="btn btn-warning text-white float-end font-12"><i class="fa fa-download align-middle me-2"></i>دانلود</a></td>

                                                            </tr>
                                                        @endforeach
                                                        </table>
                                                    </tr>
                                                @endforeach

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div><!-- end course item -->

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection