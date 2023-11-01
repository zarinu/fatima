@extends('layouts.admin')
@section('title', $title)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- User form -->
            <div class="card card-default">

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="/admin/discounts/{{!empty($discount) ? $discount->id . '/update' : 'store'}}">
                    @csrf

                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="user_id" class="control-label mr-2">شناسه کاربر</label>
                                    <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                        <option disabled selected>انتخاب کنید</option>
                                        @foreach(\App\Models\User::all() as $user)
                                            <option {{old('user_id', !empty($discount) ? $discount->user_id : null) == $user->id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name . ' - ' . $user->mobile}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="code" class="control-label mr-2">کد تخفیف</label>

                                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code"
                                           value="{{old('code', !empty($discount) ? $discount->code : generateRandomString(10))}}">
                                </div>
                                @error('code')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="type" class="control-label mr-2">نوع کد تخفیف</label>
                                    <select class="form-control" id="type" name="type">
                                        <option disabled selected>انتخاب کنید</option>
                                        @foreach(\App\Models\Discount::$types as $key => $value)
                                            <option {{old('type', !empty($discount) ? $discount->type : null) == $key ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('type')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="value" class="control-label mr-2">میزان تخفیف</label>

                                    <input type="number" class="form-control @error('value') is-invalid @enderror" id="value" name="value"
                                           value="{{old('value', !empty($discount) ? $discount->value : null)}}">
                                </div>
                                @error('value')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="count" class="control-label mr-2">دفعات استفاده</label>

                                    <input type="number" class="form-control @error('count') is-invalid @enderror" id="count" name="count"
                                           value="{{old('count', !empty($discount) ? $discount->count : null)}}">
                                </div>
                                @error('count')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="start_at" class="control-label mr-2">تاریخ شروع</label>

                                    <input type="datetime-local" class="form-control @error('start_at') is-invalid @enderror" id="start_at" name="start_at"
                                           value="{{old('start_at', !empty($discount) ? $discount->start_at : null)}}">
                                </div>
                                @error('start_at')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="expire_at" class="control-label mr-2">تاریخ اتمام</label>

                                    <input type="datetime-local" class="form-control @error('expire_at') is-invalid @enderror" id="expire_at" name="expire_at"
                                           value="{{old('expire_at', !empty($discount) ? $discount->expire_at : null)}}">
                                </div>
                                @error('expire_at')
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