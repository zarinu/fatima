@extends('layouts.admin')
@section('title', $title)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- User form -->
            <div class="card card-default">

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="/admin/orders/{{!empty($order) ? $order->id . '/update' : 'store'}}">
                    @csrf

                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="user_id" class="control-label mr-2">کاربر</label>
                                    <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" {{!empty($order) ? 'disabled' : ''}}>
                                        <option disabled selected>انتخاب کنید</option>
                                        @foreach(\App\Models\User::all() as $user)
                                            <option {{old('user_id', !empty($order) ? $order->user_id : null) == $user->id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name . ' - ' . $user->mobile}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="price" class="control-label mr-2">قیمت کلی سفارش</label>

                                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                                           placeholder="مبلغ کلی سفارش را وارد کنید" value="{{old('price', !empty($order) ? $order->price : null)}}">
                                </div>
                                @error('price')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="discount_price" class="control-label mr-2">مبلغ تخفیف سفارش</label>

                                    <input type="text" class="form-control @error('discount_price') is-invalid @enderror" id="discount_price" name="discount_price"
                                           value="{{old('discount_price', !empty($order) ? $order->discount_price : null)}}">
                                </div>
                                @error('discount_price')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="description" class="control-label mr-2">توضیحات</label>

                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{old('description', !empty($order) ? $order->description : null)}}</textarea>
                                </div>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="items" class="control-label mr-2">دوره های سفارش</label>
                                    <select class="form-control" id="items" name="items[]" multiple {{!empty($order) ? 'disabled' : ''}}>
                                        <option disabled>انتخاب کنید</option>
                                        @foreach(\App\Models\Course::all() as $course)
                                            <option {{in_array($course->id, old('items', !empty($order) ? $order->items()->pluck('course_id')->toArray() : [])) ? 'selected' : ''}} value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('items')
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