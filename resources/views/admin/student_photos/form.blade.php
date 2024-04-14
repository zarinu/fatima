@extends('layouts.admin')
@section('title', $title)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- User form -->
            <div class="card card-default">

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="/admin/student-photos/store" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row mb-2">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="title" class="control-label mr-2">عنوان تصویر</label>

                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                                           value="{{old('title', !empty($student_photo) ? $student_photo->title : null)}}">
                                </div>
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="course_id" class="control-label mr-2">دوره</label>
                                    <select class="form-control @error('course_id') is-invalid @enderror" id="course_id" name="course_id">
                                        <option disabled selected>انتخاب کنید</option>
                                        @foreach(\App\Models\Course::all() as $course)
                                            <option {{old('course_id', !empty($student_photo) ? $student_photo->course_id : null) == $course->id ? 'selected' : ''}} value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('course_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="order" class="control-label mr-2"> ترتیب عکس </label>

                                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order"
                                           value="{{old('order', !empty($student_photo) ? $student_photo->order : null)}}">
                                </div>
                                @error('order')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div>
                                    <div class="form-group">
                                        <label for="image" class="control-label mr-2">بارگزاری تصویر</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">اعمال</button>
                    </div>
                    <!-- /.card-footer -->
                </form>

            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection