@extends('layouts.admin')
@section('title', 'لیست نظرات')

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
                            <th> نام </th>
                            <th> موبایل </th>
                            <th> دوره </th>
                            <th> محتوای نظر </th>
                            <th> وضعیت </th>
                            <th> امتیاز </th>
                            <th> زیر نظر؟ </th>
                            <th> تاریخ ثبت </th>
                            <th> عملیات </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{$comment->id}}</td>
                                <td>{{$comment->name}}</td>
                                <td>{{$comment->mobile}}</td>
                                <td>{{$comment->course->name}}</td>
                                <td>{{mb_substr($comment->content, 0, 100)}}</td>
                                <td>
                                    <span class="badge badge-{{\App\Models\Comment::$statusesLabels[$comment->status]}}">
                                        {{\App\Models\Comment::$statuses[$comment->status]}}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-pill">
                                        @for($x=1; $x<= $comment->rate; $x++)
                                            <i class="fa fa-star text-warning"></i>
                                        @endfor
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-{{empty($comment->parent_id) ? 'pill' : 'danger'}}">{{empty($comment->parent_id) ? 'خیر' : 'بله'}}</span>
                                </td>
                                <td>{{\Morilog\Jalali\Jalalian::fromCarbon($comment->created_at)->format('%d %B %Y - %H:i')}}</td>
                                <td>
                                    <div class="row">

                                        @if($comment->status == 'active')
                                            <a class="m-2" href="/admin/comments/{{$comment->id}}/inactivate"> غیرفعال</a>
                                        @else
                                            <a class="m-2" href="/admin/comments/{{$comment->id}}/activate"><i class="fa fa-check"></i> تأیید</a>
                                        @endif

                                    </div>

                                    <div class="row">
                                        <a class="m-2" href="/admin/comments/{{$comment->id}}/edit"><i class="fa fa-edit"></i></a>
                                        <a class="m-2" href="/admin/comments/{{$comment->id}}/delete" onclick="return confirm('واقعا میخوای این نظر رو حذف کنی؟');"><i class="fa fa-trash"></i></a>
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