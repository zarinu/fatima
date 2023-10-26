@extends('layouts.admin')
@section('title', $title)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- User form -->
            <div class="card card-default">

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="/admin/courses/{{$course->id}}/chapters/{{!empty($chapter) ? $chapter->id . '/update' : 'store'}}">
                    @csrf

                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="name" class="control-label mr-2"> سرفصل </label>

                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                           value="{{old('name', !empty($chapter) ? $chapter->name : null)}}">
                                </div>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="order" class="control-label mr-2"> ترتیب سرفصل </label>

                                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order"
                                           value="{{old('order', !empty($chapter) ? $chapter->order : null)}}">
                                </div>
                                @error('order')
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