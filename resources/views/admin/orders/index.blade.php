@extends('layouts.admin')
@section('title', 'لیست سفارشات')

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
                            <th> نام کاربر <i class="fa fa-user-circle-o"></i></th>
                            <th> تعداد آیتم ها </th>
                            <th> قیمت <i class="fa fa-money"></i></th>
                            <th> وضعیت </th>
                            <th> تاریخ ثبت </th>
                            <th> عملیات </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->items->count()}}</td>
                                <td>{{number_format($order->price)}} تومان </td>
                                <td>
                                    <span class="badge badge-{{\App\Models\Order::$statusesLabels[$order->status]}}">
                                        {{\App\Models\Order::$statuses[$order->status]}}
                                    </span>
                                </td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    <a class="m-2" href="/admin/orders/{{$order->id}}/edit"><i class="fa fa-edit"></i></a>
                                    <a class="m-2" href="/admin/orders/{{$order->id}}/delete" onclick="return confirm('واقعا میخوای این سفارش و پرداخت های مرتبطش رو حذف کنی؟ دسترسی کاربر به دوره ها قطع خواهد شد.');"><i class="fa fa-trash"></i></a>
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