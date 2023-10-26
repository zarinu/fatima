@extends('layouts.admin')
@section('title', $title)

@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="mb-3">
                <a type="button" href="/admin/courses/{{$course->id}}/chapters/create" class="btn btn-primary">افزودن سرفصل جدید</a>
            </div>

            <div class="card">
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th> سرفصل </th>
                            <th> عملیات </th>
                        </tr>

                        @foreach($chapters as $chapter)
                            <tr>
                                <td>{{$chapter->id}}</td>
                                <td>{{$chapter->name}}</td>
                                <td>
                                    <a class="m-2" href="/admin/courses/{{$course->id}}/chapters/{{$chapter->id}}/edit"><i class="fa fa-edit"></i></a>
                                    <a class="m-2" href="/admin/courses/{{$course->id}}/chapters/{{$chapter->id}}/delete" onclick="return confirm('واقعا میخوای سرفصل ` {{$chapter->name}} ` و دروسش رو حذف کنی؟');"><i class="fa fa-trash"></i></a>
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