<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class UsersCoursesController extends Controller
{
    public function index()
    {
        $data['sidebar_item'] = 'users_courses';
        $data['users_courses'] = UserCourse::all();
        return view('admin.users_courses.index', $data);
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
