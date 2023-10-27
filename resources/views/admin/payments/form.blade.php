@extends('layouts.admin')
@section('title', $title)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- User form -->
            <div class="card card-default">

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="/admin/payments/{{!empty($payment) ? $payment->id . '/update' : 'store'}}">
                    @csrf

                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="order_id" class="control-label mr-2">شناسه سفارش</label>
                                    <select class="form-control @error('order_id') is-invalid @enderror" id="order_id" name="order_id" {{!empty($payment) ? 'disabled' : ''}}>
                                        <option disabled selected>انتخاب کنید</option>
                                        @foreach(\App\Models\Order::all() as $order)
                                            <option {{old('order_id', !empty($payment) ? $payment->order_id : null) == $order->id ? 'selected' : ''}} value="{{$order->id}}">{{'سفارش: #' . $order->id . ' / کاربر: ' . $order->user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('order_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="amount" class="control-label mr-2">مبلغ پرداخت</label>

                                    <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount"
                                           placeholder="مبلغ کلی سفارش را وارد کنید" value="{{!empty(session('amount')) ? session('amount') : old('amount', !empty($payment) ? $payment->amount : null)}}">
                                </div>
                                @error('amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="status" class="control-label mr-2">وضعیت پرداخت</label>
                                    <select class="form-control" id="status" name="status">
                                        <option disabled selected>انتخاب کنید</option>
                                        @foreach(\App\Models\Payment::$statuses as $key => $value)
                                            <option {{old('status', !empty($payment) ? $payment->status : null) == $key ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="description" class="control-label mr-2">توضیحات</label>

                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{old('description', !empty($payment) ? $payment->description : null)}}</textarea>
                                </div>
                                @error('description')
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