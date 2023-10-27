<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserCourse;
use App\Models\UserViewedLesson;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $data['sidebar_item'] = 'orders';
        $data['orders'] = Order::all();
        return view('admin.orders.index', $data);
    }

    public function create()
    {
        $data['sidebar_item'] = 'orders_create';
        $data['title'] = 'ثبت سفارش';
        return view('admin.orders.form', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'price' => 'nullable|integer',
            'discount_price' => 'nullable|integer',
            'description' => 'nullable|string',
            'items' => 'required|array|distinct',
            'items.*' => 'nullable|integer',
        ]);

        if(!empty($validated['price']) && !empty($validated['discount_price'])) {
            $validated['total_price'] = $validated['price'] - $validated['discount_price'];
        } elseif(!empty($validated['price'])) {
            $validated['total_price'] = $validated['price'];
        }

        if($order = Order::create($validated)) {
            foreach ($validated['items'] as $item) {
                OrderItem::create([
                   'user_id' => $validated['user_id'],
                   'order_id' => $order->id,
                   'course_id' => $item,
                ]);
            }

            return redirect('/admin/payments/create')->with([
                'status' => 'success',
                'message' => 'سفارش با موفقیت ثبت شد. پرداخت مربوطه را ایجاد کنید.',
                'order_id' => $order->id,
                'amount' => $order->total_price,
            ]);
        }

        return back();
    }

    public function edit(Order $order)
    {
        $data['sidebar_item'] = 'orders_create';
        $data['title'] = 'ویرایش سفارش شماره ' . $order->id . '#';
        $data['order'] = $order;
        return view('admin.orders.form', $data);
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'price' => 'nullable|integer',
            'discount_price' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        if(!empty($validated['price']) && !empty($validated['discount_price'])) {
            $validated['total_price'] = $validated['price'] - $validated['discount_price'];
        } elseif(!empty($validated['price'])) {
            $validated['total_price'] = $validated['price'];
        }

        $order->fill($validated);
        $order->save();

        return redirect('/admin/orders')->with([
            'status' => 'success',
            'message' => 'سفارش با موفقیت ویرایش شد.',
        ]);
    }

    public function delete(Order $order)
    {
        $order_items = $order->items();
        UserCourse::where('user_id', $order->id)
            ->whereIn('course_id', $order_items->pluck('course_id')->toArray())
            ->delete();
        UserViewedLesson::where('user_id', $order->id)
        ->whereIn('course_id', $order_items->pluck('course_id')->toArray())
        ->delete();
        $order->payments()->delete();
        $order_items->delete();
        $order->delete();

        return redirect('/admin/orders')->with([
            'status' => 'success',
            'message' => 'سفارش با موفقیت حذف شد.',
        ]);
    }
}
