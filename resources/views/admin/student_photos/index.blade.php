@extends('layouts.admin')
@section('title', 'لیست تصاویر هنرجویان')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body" style="overflow-x: auto;">
                    <table id='empTable' class="table table-bordered table-responsive table-responsive-xxl table-hover table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> عنوان </th>
                            <th> دوره </th>
                            <th> تصویر </th>
                            <th> اولویت </th>
                            <th> عملیات </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">

        $(document).ready(function(){
            // Initialize
            $('#empTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('student_photos.grid') }}",
                columns: [
                    { data: 'id' },
                    { data: 'title' },
                    { data: 'course_id' },
                    { data: 'image' },
                    { data: 'order' },
                    { data: 'action', orderable:false },
                ],
                "oLanguage": {
                    "sUrl": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json"
                },
            });
        });

    </script>
@endpush