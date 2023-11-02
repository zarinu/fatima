@extends('layouts.admin')
@section('title', $title)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- User form -->
            <div class="card card-default">

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="/admin/users-courses/store">
                    @csrf

                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="user_id" class="control-label mr-2">کاربر</label>
                                    <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                        <option disabled selected>انتخاب کنید</option>
                                        @foreach(\App\Models\User::all() as $user)
                                            <option {{old('user_id') == $user->id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name . ' - ' . $user->mobile}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="course_id" class="control-label mr-2">دوره</label>
                                    <select class="form-control @error('course_id') is-invalid @enderror" id="course_id" name="course_id">
                                        <option disabled selected>انتخاب کنید</option>
                                        @foreach(\App\Models\Course::all() as $course)
                                            <option {{old('course_id') == $course->id ? 'selected' : ''}} value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('course_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
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