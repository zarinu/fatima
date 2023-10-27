<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        $data['sidebar_item'] = 'payments';
        $data['payments'] = Payment::all();
        return view('admin.payments.index', $data);
    }

    public function create()
    {
        $data['sidebar_item'] = 'payments_create';
        $data['title'] = 'ثبت پرداخت';
        return view('admin.payments.form', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|integer',
            'amount' => 'required|integer|min:1',
            'status' => 'required|in:pending,failed,success',
            'description' => 'nullable|string',
        ]);

        $order = Order::find($validated['order_id']);

        $validated['user_id'] = $order->user_id;
        $validated['paid_at'] = time();

        $payment = Payment::create($validated);
        $order->status = $payment->status;
        $order->save();

        $this->success_payment($order);

        return redirect('/admin/payments')->with([
            'status' => 'success',
            'message' => 'پرداخت با موفقیت ثبت شد.',
        ]);
    }

    public function edit(Payment $payment)
    {
        $data['sidebar_item'] = 'payments_create';
        $data['title'] = 'ویرایش پرداخت شماره ' . $payment->id . '#';
        $data['payment'] = $payment;
        return view('admin.payments.form', $data);
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'amount' => 'required|integer|min:1',
            'status' => 'required|in:pending,failed,success',
            'description' => 'nullable|string',
        ]);

        $payment->fill($validated);
        $payment->save();

        $order = $payment->order;
        $order->status = $payment->status;
        $order->save();

        $this->success_payment($order);

        return redirect('/admin/payments')->with([
            'status' => 'success',
            'message' => 'پرداخت با موفقیت ویرایش شد.',
        ]);
    }

    public function delete(Payment $payment)
    {
        $order = $payment->order;
        $order->status = 'pending';
        $order->save();
        $payment->delete();

        return redirect('/admin/payments')->with([
            'status' => 'success',
            'message' => 'پرداخت با موفقیت حذف شد.',
        ]);
    }

    /**
     * @param $payment
     * @param $order
     * @return void
     */
    private function success_payment($order): void
    {
        if ($order->status == 'success') {
            foreach ($order->items as $item) {
                $user_course_item = [
                    'user_id' => $item->user_id,
                    'course_id' => $item->course_id,
                ];
                if (!UserCourse::where($user_course_item)->first()) {
                    UserCourse::create($user_course_item);
                    $item->course->increment('users_count');
                }
            }
        }
    }
}
