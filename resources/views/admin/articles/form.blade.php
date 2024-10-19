@extends('layouts.admin')
@section('title', $title)

@section('content')
{{--    {{dd($errors)}}--}}
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- User form -->
            <div class="card card-default">

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="/admin/articles/{{!empty($articles) ? $articles->id . '/update' : 'store'}}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="title" class="control-label mr-2">عنوان مقاله</label>

                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                                           placeholder="عنوان مقاله را وارد کنید" value="{{old('title', !empty($articles) ? $articles->title : null)}}">
                                </div>
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="order" class="control-label mr-2">ترتیب مقاله</label>

                                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order"
                                           placeholder="ترتیب مقاله ات کدومه" value="{{old('order', !empty($articles) ? $articles->order : null)}}">
                                </div>
                                @error('order')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="status" class="control-label mr-2">وضعیت مقاله</label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                            <option disabled selected>انتخاب کنید</option>
                                            @foreach(\App\Models\Article::$statuses as $key => $value)
                                                <option {{old('status', !empty($articles) ? $articles->status : null) == $key ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="difficulty_level" class="control-label mr-2">درجه سختی</label>
                                    <select class="form-control @error('difficulty_level') is-invalid @enderror" id="difficulty_level" name="difficulty_level">
                                        <option disabled selected>انتخاب کنید</option>
                                        @foreach(\App\Models\Article::$difficulty_levels as $key => $value)
                                            <option {{old('difficulty_level', !empty($articles) ? $articles->difficulty_level : null) == $key ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('difficulty_level')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="tags" class="control-label mr-2">تگ های مقاله</label>

                                    <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags"
                                           placeholder="تگ های مقاله رو با ، جدا کنید" value="{{old('tags', !empty($articles) ? $articles->tags : null)}}">
                                </div>
                                @error('tags')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="estimated_time" class="control-label mr-2">زمان مورد نیاز برای مطالعه</label>

                                    <input type="number" class="form-control @error('estimated_time') is-invalid @enderror" id="estimated_time" name="estimated_time"
                                           value="{{old('estimated_time', !empty($articles) ? $articles->estimated_time : null)}}">
                                </div>
                                @error('estimated_time')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="abstract" class="control-label mr-2">خلاصه مقاله</label>

                                    <textarea class="form-control @error('abstract') is-invalid @enderror" id="abstract" name="abstract"
                                              placeholder="حدودا ۲۰۰ کاراکتر باشه">{{old('abstract', !empty($articles) ? $articles->abstract : null)}}</textarea>
                                </div>
                                @error('abstract')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="content" class="control-label mr-2">محتوای مقاله</label>
                                    <textarea id="editor1" name="content" rows="7" style="width: 100%">{{old('content', !empty($articles) ? $articles->content : null) ?: 'متن مورد نظر را وارد نمایید'}}</textarea>
                                </div>
                                @error('content')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <div>
                                    <div class="form-group">
                                        <label for="image" class="control-label mr-2">عکس اصلی مقاله</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if(!empty($articles) && $articles->has_image)
                                <div class="mr-xl-5">
                                    <strong class="text-success">عکس فعلی در زیر نمایش داده شده است.</strong>
                                    <p class="text-success"> برای تغییر دکمه browse را انتخاب کنید.</p>
                                    <img src="{{$articles->get_image()}}" width="200px" height="200px">
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <div>
                                    <div class="form-group">
                                        <label for="video" class="control-label mr-2">فیلم مقاله</label>
                                        <input type="file" class="form-control" id="video" name="video">
                                    </div>
                                    @error('video')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if(!empty($articles) && $articles->has_video)
                                    <div class="mr-xl-5">
                                        <strong class="text-success">فیلم فعلی در زیر نمایش داده شده است.</strong>
                                        <p class="text-success"> برای تغییر دکمه browse را انتخاب کنید.</p>
                                        <video width="200px" height="200px" controls>
                                            <source src="{{$articles->get_video()}}">
                                        </video>
                                    </div>
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
    <script src="{{ asset('/assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function () {
            ClassicEditor
                .create(document.querySelector('#editor1'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'imageUpload'],
                    ckfinder: {
                        uploadUrl: '/admin/articles/upload-image', // Laravel route for image upload
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Include CSRF token in headers
                        }
                    }
                })
                .then(editor => {
                    // The editor instance is ready
                })
                .catch(error => {
                    console.error(error);
                });

            $('.textarea').wysihtml5({
                toolbar: { fa: true }
            });
        });

    </script>
@endpush