<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    public function index()
    {
        return view('web.cart.index');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addItem(Course $course)
    {
        if(in_array($course->status, ['not_for_sale', 'inactive'])) {
            return back()->with([
                'status' => 'danger',
                'message' => 'دوره غیر قابل خریداری است.',
            ]);
        }
        $course_id = $course->id;
        $cart = session()->get('cart', []);
        if(empty($cart['items'][$course_id])) {
            $cart['items'][$course_id] = [
                'name' => $course->name,
                'price' => $course->price,
                'discount_percent' => $course->discount_percent ?: 0,
                'discount_price' => $course->discount_percent ? ($course->price*$course->discount_percent/100) : 0,
                'image' => $course->get_cover()
            ];

            $this->update_cart($cart);
            session()->put('cart', $cart);
            return back()->with([
                'status' => 'success',
                'message' => 'دوره با موفقیت به سبد خرید اضافه شد!',
            ]);
        } else {
            return back()->with([
                'status' => 'danger',
                'message' => 'این دوره قبلا به سبد خرید اضافه شده است.',
            ]);
        }
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function deleteItem(Request $request)
    {
        $course_id = $request->course_id;
        if(empty($course_id)) {
            return;
        }
        $cart = session()->get('cart');
        if(!empty($cart['items'][$course_id])) {
            unset($cart['items'][$course_id]);

            $this->update_cart($cart);
            session()->put('cart', $cart);

            if(count($cart['items']) == 0) {
                session()->forget('cart');
            }
        }
        session()->flash('status', 'success');
        session()->flash('message', 'دوره با موفقیت از سبد خرید حذف شد.');
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws ValidationException
     */
    public function applyDiscountCode(Request $request)
    {
        $cart = session()->get('cart');
        if(!empty($cart['discount_type'])) {
            throw ValidationException::withMessages(['discount_code' => 'کد تخفیف دیگری برای این سفارش فعال است']);
        }

        $discount_code = $request->discount_code;
        if(empty($discount_code)) {
            throw ValidationException::withMessages(['discount_code' => 'لطفا کد تخفیف را وارد کنید']);
        }

        // find the code in discounts table
        $discount = Discount::where('code', $discount_code)->first();
        if(empty($discount)) {
            throw ValidationException::withMessages(['discount_code' => 'کد تخفیف معتبر نیست']);
        }

        if($discount->count <= 0) {
            throw ValidationException::withMessages(['discount_code' => 'تعداد دفعات استفاده از کد تخفیف به پایان رسیده است']);
        }

        if(!empty($discount->user_id) && ($discount->user_id != auth()->id())) {
            throw ValidationException::withMessages(['discount_code' => 'کد تخفیف متعلق به شما نیست']);
        }

        if(Carbon::make($discount->start_at)->gt(Carbon::now())) {
            throw ValidationException::withMessages(['discount_code' => 'زمان استفاده از کد تخفیف فرا نرسیده است']);
        }

        if(Carbon::make($discount->expire_at)->lt(Carbon::now())) {
            throw ValidationException::withMessages(['discount_code' => 'کد تخفیف منقضی شده است']);
        }

        // Start the process of apply discount code for the user CART
        $cart['discount_type'] = $discount->type;
        $cart['discount_value'] = $discount->value;
        $cart['discount_code_price'] = $discount->value;
        $cart['discount_id'] = $discount->id;
        $discount->decrement('count');

        $this->update_cart($cart);
        session()->put('cart', $cart);
        session()->flash('status', 'success');
        session()->flash('message', 'کد تخفیف با موفقیت اعمال شد.');
        return back();
    }

    private function update_cart(&$cart) {
        $cart['price'] = 0;
        $cart['total_discount_price'] = 0;
        foreach ($cart['items'] as $item) {
            $cart['price'] += $item['price'];
            $cart['total_discount_price'] += $item['discount_price'];
        }

        if(!empty($cart['discount_type'])) {
            if($cart['discount_type'] == 'percentage') {
                $cart['discount_code_price'] = (($cart['price']-$cart['total_discount_price']) * $cart['discount_value'] / 100);
                $cart['total_discount_price'] += $cart['discount_code_price'];
            } else {
                $cart['total_discount_price'] += $cart['discount_value'];
            }
        }
    }
}
