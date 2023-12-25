@extends('layouts.admin')
@section('title', 'لیست کاربران')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body" style="overflow-x: auto;">
                    <table id='empTable' class="table table-bordered table-responsive table-responsive-xxl table-hover table-striped">
                        <thead>
                        <tr>
                            <th> شناسه </th>
                            <th> نام </th>
                            <th> موبایل </th>
                            <th> تاریخ ثبت </th>
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
                ajax: "{{ route('users.grid') }}",
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'mobile' },
                    { data: 'created_at' },
                    { data: 'action' },
                ],
                "oLanguage": {
                    "sUrl": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json"
                },
            });
        });

    </script>
@endpush