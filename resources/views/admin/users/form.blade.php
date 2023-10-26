@extends('layouts.admin')
@section('title', $title)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- User form -->
            <div class="card card-default">

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="/admin/users/{{!empty($user) ? $user->id . '/update' : 'store'}}">
                    @csrf

                    <div class="card-body">
                        <div class="row row mb-2">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="name" class="control-label mr-2">نام</label>

                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                           placeholder="نام کاربر را وارد کنید" value="{{old('name', !empty($user) ? $user->name : null)}}">
                                </div>

                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="mobile" class="control-label mr-2">موبایل</label>

                                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile"
                                           placeholder="موبایل را وارد کنید" value="{{old('mobile', !empty($user) ? $user->mobile : null)}}">
                                </div>

                                @error('mobile')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="password" class="control-label mr-2">پسورد</label>

                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                           placeholder="رمز را وارد کنید" value="{{old('password')}}">

                                    <p class="mr-2" style="font-size: 13px">در صورت وارد نکردن رمز، ۱۲۳۴۵۶۷۸۹ به عنوان رمز ثبت خواهد شد.</p>
                                </div>

                                @error('password')
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