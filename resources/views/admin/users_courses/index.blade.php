@extends('layouts.admin')
@section('title', 'لیست دوره های فعال کاربران')

@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <!-- /.card-header -->
                <div class="card-body" style="overflow-x: auto;">
                    <table id="example1" class="table table-bordered table-responsive table-responsive-xxl table-hover table-striped">
                        <thead>
                        <tr>
                            <th> کاربر </th>
                            <th> موبایل </th>
                            <th> دوره </th>
                            <th> تاریخ ثبت </th>
                            <th> غیرفعال کردن دوره برای کاربر </th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div> <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@push('scripts')
    <script type="text/javascript">

        $(document).ready(function(){
            // Initialize
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user_courses.grid') }}",
                columns: [
                    { data: 'user_name', name: 'user.name'},
                    { data: 'user_mobile', name: 'user.mobile'},
                    { data: 'course_name', name: 'course.name'},
                    { data: 'created_at' },
                    { data: 'action', orderable:false },
                ],
                "oLanguage": {
                    "sUrl": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json"
                },
            });
        });

    </script>
@endpush