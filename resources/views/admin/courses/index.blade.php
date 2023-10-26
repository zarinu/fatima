@extends('layouts.admin')
@section('title', 'لیست دوره ها')

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
                            <th> عکس <i class="fa fa-picture-o"></i></th>
                            <th> نام <i class="fa fa-leaf"></i></th>
                            <th> وضعیت </th>
                            <th> قیمت <i class="fa fa-money"></i></th>
                            <th> درصد تخفیف <i class="fa fa-percent"></i></th>
                            <th> عملیات </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{$course->id}}</td>
                                <td class="image">
                                    <img class="img-circle elevation-2" width="50px" height="50px" src="{{$course->get_cover()}}">
                                </td>
                                <td>{{$course->name}}</td>
                                <td>
                                    <span class="badge badge-{{\App\Models\Course::$statusesLabels[$course->status]}}">
                                        {{\App\Models\Course::$statuses[$course->status]}}
                                    </span>
                                </td>
                                <td>{{number_format($course->price)}} تومان </td>
                                <td>%{{$course->discount_percent ?: 0}}</td>
                                <td>
                                    <div>
                                        <a class="m-2" href="/admin/courses/{{$course->id}}/edit"><i class="fa fa-edit"></i></a>
                                        <a class="m-2" href="/admin/courses/{{$course->id}}/chapters"><span class="badge badge-primary">سرفصلها</span></a>
                                    </div>
                                    <div>
                                        <a class="m-2" href="/admin/courses/{{$course->id}}/lessons"><span class="badge badge-primary">درسها</span></a>
                                        <a class="m-2" href="/admin/courses/{{$course->id}}/delete" onclick="return confirm('واقعا میخوای ` {{$course->name}} ` و تمام سرفصل ها و دروسش رو حذف کنی؟');"><i class="fa fa-trash"></i></a>
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