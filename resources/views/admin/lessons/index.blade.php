@extends('layouts.admin')
@section('title', $title)

@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="mb-3">
                <a type="button" href="/admin/courses/{{$course->id}}/lessons/create" class="btn btn-primary">افزودن درس جدید</a>
            </div>

            <div class="card">
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th> عنوان </th>
                            <th> سرفصل </th>
                            <th> عملیات </th>
                        </tr>

                        @foreach($lessons as $lesson)
                            <tr>
                                <td>{{$lesson->id}}</td>
                                <td>{{$lesson->title}}</td>
                                <td>{{$lesson->chapter->name}}</td>
                                <td>
                                    <a class="m-2" href="/admin/courses/{{$course->id}}/lessons/{{$lesson->id}}/edit"><i class="fa fa-edit"></i></a>
                                    <a class="m-2" href="/admin/courses/{{$course->id}}/lessons/{{$lesson->id}}/delete" onclick="return confirm('واقعا میخوای درس ` {{$lesson->title}} ` رو حذف کنی؟');"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div> <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection