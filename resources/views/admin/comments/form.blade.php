@extends('layouts.admin')
@section('title', $title)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- User form -->
            <div class="card card-default">

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="/admin/comments/{{$comment->id}}/update">
                    @csrf

                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="name" class="control-label mr-2">نام نظردهنده</label>

                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                           value="{{old('name', $comment->name)}}">
                                </div>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="status" class="control-label mr-2">وضعیت نظر</label>
                                    <select class="form-control" id="status" name="status">
                                        @foreach(\App\Models\Comment::$statuses as $key => $value)
                                            <option {{old('status', $comment->status) == $key ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="content" class="control-label mr-2">محتوا</label>

                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3">{{old('content', $comment->content)}}</textarea>
                                </div>
                                @error('content')
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