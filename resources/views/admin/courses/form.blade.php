@extends('layouts.admin')
@section('title', $title)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- User form -->
            <div class="card card-default">

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="/admin/courses/{{!empty($course) ? $course->id . '/update' : 'store'}}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="name" class="control-label mr-2">نام دوره</label>

                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                           placeholder="نام دوره را وارد کنید" value="{{old('name', !empty($course) ? $course->name : null)}}">
                                </div>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="total_hours" class="control-label mr-2">مجموع ساعات</label>

                                    <input type="text" class="form-control @error('total_hours') is-invalid @enderror" id="total_hours" name="total_hours"
                                           placeholder="تعداد کل ساعتهای دوره را وارد کنید" value="{{old('total_hours', !empty($course) ? $course->total_hours : null)}}">
                                </div>
                                @error('total_hours')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="price" class="control-label mr-2">قیمت دوره</label>

                                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                                           placeholder="قیمت کلی دوره را وارد کنید" value="{{old('price', !empty($course) ? $course->price : null)}}">
                                </div>
                                @error('price')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="discount_percent" class="control-label mr-2">درصد تخفیف</label>

                                    <input type="text" class="form-control @error('discount_percent') is-invalid @enderror" id="discount_percent" name="discount_percent"
                                           placeholder="دوره ات تخفیف داره؟ بزن" value="{{old('discount_percent', !empty($course) ? $course->discount_percent : null)}}">
                                </div>
                                @error('discount_percent')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="order" class="control-label mr-2">ترتیب دوره</label>

                                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order"
                                           placeholder="ترتیب دوره ات کدومه" value="{{old('order', !empty($course) ? $course->order : null)}}">
                                </div>
                                @error('order')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="status" class="control-label mr-2">وضعیت دوره</label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                            <option disabled selected>انتخاب کنید</option>
                                            @foreach(\App\Models\Course::$statuses as $key => $value)
                                                <option {{old('status', !empty($course) ? $course->status : null) == $key ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="summery" class="control-label mr-2">خلاصه دوره</label>

                                    <textarea class="form-control @error('summery') is-invalid @enderror" id="summery" name="summery"
                                              placeholder="حدودا ۲۰۰ کاراکتر باشه">{{old('summery', !empty($course) ? $course->summery : null)}}</textarea>
                                </div>
                                @error('summery')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="private_description" class="control-label mr-2">توضیحات خصوصی</label>
                                    <textarea id="private_description" class="form-control @error('summery') is-invalid @enderror" name="private_description">{{old('private_description', !empty($course) ? $course->private_description : null) ?: 'شماره تماس خانم حیدری پشتیبان : 09377819036'}}</textarea>
                                </div>
                                <span style="font-size: 12px"> 👆 محتوای این فیلد بالا را فقط اعضای این دوره خواهند دید: اطلاعاتی مثل شماره موبایل مدرس دوره</span>
                                @error('private_description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="description" class="control-label mr-2">توضیحات</label>
                                    <textarea id="editor1" name="description" style="width: 100%">{{old('description', !empty($course) ? $course->description : null) ?: 'متن مورد نظر را وارد نمایید'}}</textarea>
                                </div>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <div>
                                    <div class="form-group">
                                        <label for="cover" class="control-label mr-2">عکس اصلی</label>
                                        <input type="file" class="form-control" id="cover" name="cover">
                                    </div>
                                    @error('cover')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if(!empty($course) && $course->has_cover)
                                <div class="mr-xl-5">
                                    <strong class="text-success">عکس فعلی در زیر نمایش داده شده است.</strong>
                                    <p class="text-success"> برای تغییر دکمه browse را انتخاب کنید.</p>
                                    <img src="{{$course->get_cover()}}" width="200px" height="200px">
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <div>
                                    <div class="form-group">
                                        <label for="video" class="control-label mr-2">فیلم دوره</label>
                                        <input type="file" class="form-control" id="video" name="video">
                                    </div>
                                    @error('video')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if(!empty($course) && $course->has_video)
                                    <div class="mr-xl-5">
                                        <strong class="text-success">فیلم فعلی در زیر نمایش داده شده است.</strong>
                                        <p class="text-success"> برای تغییر دکمه browse را انتخاب کنید.</p>
                                        <video width="200px" height="200px" controls>
                                            <source src="{{$course->get_video()}}">
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