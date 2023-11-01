<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountsController extends Controller
{
    public function index()
    {
        $data['sidebar_item'] = 'discounts';
        $data['discounts'] = Discount::all();
        return view('admin.discounts.index', $data);
    }

    public function create()
    {
        $data['sidebar_item'] = 'discounts_create';
        $data['title'] = 'ثبت کد تخفیف';
        return view('admin.discounts.form', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|integer',
            'code' => 'required|string|between:3,10',
            'type' => 'required|in:percentage,numeric',
            'value' => 'required|integer',
            'count' => 'nullable|integer',
            'start_at' => 'required|date',
            'expire_at' => 'required|date',
        ]);

        if(empty($validated['count'])) {
            $validated['count'] = 1;
        }

        Discount::create($validated);

        return redirect('/admin/discounts')->with([
            'status' => 'success',
            'message' => 'کد تخفیف با موفقیت ثبت شد.',
        ]);
    }

    public function edit(Discount $discount)
    {
        $data['sidebar_item'] = 'discounts_create';
        $data['title'] = 'ویرایش کد تخفیف شماره ' . $discount->id . '#';
        $data['discount'] = $discount;
        return view('admin.discounts.form', $data);
    }

    public function update(Request $request, Discount $discount)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|integer',
            'code' => 'required|string|between:3,10',
            'type' => 'required|in:percentage,numeric',
            'value' => 'required|integer',
            'count' => 'required|integer',
            'start_at' => 'required|date',
            'expire_at' => 'required|date',
        ]);

        $discount->fill($validated)->save();

        return redirect('/admin/discounts')->with([
            'status' => 'success',
            'message' => 'کد تخفیف با موفقیت ویرایش شد.',
        ]);
    }

    public function delete(Discount $discount)
    {
        $discount->delete();
        return redirect('/admin/discounts')->with([
            'status' => 'success',
            'message' => 'کد تخفیف با موفقیت حذف شد.',
        ]);
    }
}
