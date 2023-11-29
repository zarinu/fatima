@extends('layouts.admin')
@section('title', 'لیست تصاویر هنرجویان')

@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> عنوان </th>
                            <th> تصویر </th>
                            <th> عملیات </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student_photos as $student_photo)
                            <tr>
                                <td>{{$student_photo->id}}</td>
                                <td>{{$student_photo->title ?: 'بدون عنوان'}}</td>

                                <td class="image">
                                    <img class="img-thumbnail elevation-2" width="50px" height="50px" src="{{$student_photo->photo()}}">
                                </td>

                                <td>
                                    <div class="row">
                                        <a class="m-2" href="/admin/student-photos/{{$student_photo->id}}/delete" onclick="return confirm('واقعا میخوای این عکس رو حذف کنی؟');"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div> <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables/dataTables.bootstrap4.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "language": {
                    "paginate": {
                        "next": "بعدی",
                        "previous" : "قبلی"
                    }
                },
                "info" : false,
            });
        });
    </script>
@endpush