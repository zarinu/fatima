@extends('layouts.admin')
@section('title', 'لیست دوره های فعال کاربران')

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
                            <th> کاربر </th>
                            <th> دوره </th>
                            <th> تاریخ ثبت </th>
                            <th> غیرفعال کردن دوره برای کاربر </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users_courses as $user_course)
                            <tr>
                                <td>{{$user_course->id}}</td>
                                <td>{{$user_course->user->name}}</td>
                                <td>{{$user_course->course->name}}</td>
                                <td>{{$user_course->created_at}}</td>
                                <td>
                                    <a class="m-2" href="/admin/users-courses/{{$user_course->id}}/delete" onclick="return confirm('واقعا میخوای `{{$user_course->course->name}}` رو برای `{{$user_course->user->name}}` غیرفعال کنی حذف کنی؟');"><i class="fa fa-trash"></i></a>
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