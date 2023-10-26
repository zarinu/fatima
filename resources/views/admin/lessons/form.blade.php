@extends('layouts.admin')
@section('title', $title)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- User form -->
            <div class="card card-default">

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="/admin/courses/{{$course->id}}/lessons/{{!empty($lesson) ? $lesson->id . '/update' : 'store'}}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="title" class="control-label mr-2"> عنوان درس </label>

                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                                           value="{{old('title', !empty($lesson) ? $lesson->title : null)}}">
                                </div>
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="chapter_id" class="control-label mr-2">سرفصل جلسه</label>
                                    <select class="form-control @error('chapter_id') is-invalid @enderror" id="chapter_id" name="chapter_id">
                                        <option disabled selected>انتخاب کنید</option>
                                        @foreach($course->chapters as $chapter)
                                            <option {{old('chapter_id', !empty($lesson) ? $lesson->chapter_id : null) == $chapter->id ? 'selected' : ''}} value="{{$chapter->id}}">{{$chapter->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('chapter_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="order" class="control-label mr-2"> ترتیب </label>

                                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order"
                                           value="{{old('order', !empty($lesson) ? $lesson->order : null)}}">
                                </div>
                                @error('order')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="description" class="control-label mr-2">توضیحات</label>
                                    <textarea id="editor1" name="description" style="width: 100%">{{old('description', !empty($lesson) ? $lesson->description : null)}}</textarea>
                                </div>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <div>
                                    <div class="form-group">
                                        <label for="content" class="control-label mr-2">محتوای جلسه</label>
                                        <input type="file" class="form-control" id="content" name="content">
                                    </div>
                                    @error('content')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if(!empty($lesson) && $lesson->content_path)
                                    <strong class="text-success">محتوا بارگزاری شده است. برای تغییر انتخاب کنید.</strong>
                                @else
                                    <strong class="text-danger">محتوای جلسه را بارگزاری کنید.</strong>
                                @endif
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

@push('scripts')
    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            ClassicEditor
                .create(document.querySelector('#editor1'))
                .then(function (editor) {
                    // The editor instance
                })
                .catch(function (error) {
                    console.error(error)
                })

            // bootstrap WYSIHTML5 - text editor

            $('.textarea').wysihtml5({
                toolbar: { fa: true }
            })
        })
    </script>
@endpush