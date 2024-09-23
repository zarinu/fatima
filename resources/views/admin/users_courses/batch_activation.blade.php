@extends('layouts.admin')
@section('title', $title)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- User form -->
            <div class="card card-default">

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="/admin/users-courses/batch-store" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="excel_file" class="control-label mr-2">بارگزاری فایل اکسل</label>
                                    <input type="file" class="form-control" id="excel_file" name="excel_file">
                                </div>
                                @error('excel_file')
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
