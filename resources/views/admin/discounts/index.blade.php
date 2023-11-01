@extends('layouts.admin')
@section('title', 'لیست کدهای تخفیف')

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
                            <th> کد تخفیف </th>
                            <th> نوع </th>
                            <th> مقدار </th>
                            <th> دفعات باقی </th>
                            <th> تاریخ شروع </th>
                            <th> تاریخ انقضا </th>
                            <th> عملیات </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($discounts as $discount)
                            <tr>
                                <td>{{$discount->id}}</td>
                                <td>{{$discount->code}}</td>
                                <td>
                                    <span class="badge badge-success">
                                        {{\App\Models\Discount::$types[$discount->type]}}
                                    </span>
                                </td>
                                <td>{{$discount->value}}</td>
                                <td>{{$discount->count}}</td>
                                <td>{{$discount->start_at}}</td>
                                <td>{{$discount->expire_at}}</td>
                                <td>
                                    <a class="m-2" href="/admin/discounts/{{$discount->id}}/edit"><i class="fa fa-edit"></i></a>
                                    <a class="m-2" href="/admin/discounts/{{$discount->id}}/delete" onclick="return confirm('واقعا میخوای این کد تخفیف رو حذف کنی؟');"><i class="fa fa-trash"></i></a>
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