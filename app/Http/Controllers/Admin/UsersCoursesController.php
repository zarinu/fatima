<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\UserCoursesImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class UsersCoursesController extends Controller
{
    public function index()
    {
        $data['sidebar_item'] = 'users_courses';
        return view('admin.users_courses.index', $data);
    }

    public function grid(Request $request)
    {
        if($request->ajax()){
            $data = UserCourse::with(['user', 'course'])->select('user_courses.*')->orderByRaw('user_courses.created_at DESC');
            return DataTables::eloquent($data)
                ->addColumn('action', function($row){
                    return '<a href="/admin/users-courses/'.$row->id.'/delete" class="delete btn btn-danger btn-sm mt-1" onclick="return confirm(`واقعا میخوای این دوره رو برای اون خانم غیر فعال کنی؟`)">حذف دسترسی</a>';
                })
                ->addColumn('user_name', function (UserCourse $row) { return $row->user->name; })
                ->addColumn('user_mobile', function (UserCourse $row) { return $row->user->mobile; })
                ->addColumn('course_name', function (UserCourse $row) { return $row->course->name; })
                ->editColumn('created_at', function ($row) {
                    return \Morilog\Jalali\Jalalian::fromCarbon($row->created_at)->format('%d %B %Y');
                })
                ->toJson();
        }
        return view('admin.users_courses.index');
    }

    public function create()
    {
        $data['sidebar_item'] = 'users_courses_create';
        $data['title'] = 'فعال کردن دوره برای کاربر خاص';
        return view('admin.users_courses.form', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'course_id' => 'required|integer',
        ]);
        $order = Order::create([
            'user_id' => $validated['user_id'],
            'description' => 'دوره فعال شده برای کاربر از طریق ادمین',
            'status' => 'success',
        ]);
        OrderItem::create([
            'user_id' => $validated['user_id'],
            'order_id' => $order->id,
            'course_id' => $validated['course_id'],
        ]);
        Payment::create([
            'user_id' => $validated['user_id'],
            'order_id' => $order->id,
            'amount' => 0,
            'description' => 'دوره فعال شده برای کاربر از طریق ادمین',
            'status' => 'success',
        ]);
        UserCourse::firstOrCreate($validated);

        return redirect('/admin/users-courses')->with([
            'status' => 'success',
            'message' => 'دوره برای کاربر با موفقیت فعال شد.',
        ]);
    }

    public function batchCreate()
    {
        $data['sidebar_item'] = 'users_courses_batch_create';
        $data['title'] = 'فعال سازی دوره با اکسل';
        return view('admin.users_courses.batch_activation', $data);
    }

    public function batchStore(Request $request)
    {
        // Validate the file format
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            // Handle the file upload and import
            Excel::import(new UserCoursesImport(), $request->file('excel_file'));

            return redirect('/admin/users-courses')->with([
                'status' => 'success',
                'message' => 'دوره ها برای تمام کاربران با موفقیت فعال شد.',
            ]);
        } catch (ValidationException $e) {
            // Handle validation failure
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // ردیفی که ولیدیشن آن رد شده
                $failure->attribute(); // ستونی که مشکل دارد
                $failure->errors(); // پیام‌های خطا
                $failure->values(); // مقادیر ردیف
            }
            logger($failures);
            return back()->with('error', 'Validation failed on row ' . $failure->row() . ': ' . implode(', ', $failure->errors()));
        }
    }

    public function delete(UserCourse $user_course)
    {
        $order_item = OrderItem::where('course_id', $user_course->course_id)->where('user_id', $user_course->user_id)->first();
        if($order_item) {
            $order = $order_item->order;
            $order_item->delete();
            if(count($order->items) == 0) {
                $order->payments()->delete();
                $order->delete();
            }
        }
        $user_course->delete();
        return redirect('/admin/users-courses')->with([
            'status' => 'success',
            'message' => 'دوره برای کاربر با موفقیت غیرفعال گردید.',
        ]);
    }
}
