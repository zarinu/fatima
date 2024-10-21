<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CartPayment;
use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirectLinksController extends Controller
{
    public function showFandogh() {
        return view('web.direct_links.fandogh');
    }

    public function purchaseFandogh(Request $request) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'between:3,255'],
            'mobile' => ['required', 'numeric', 'digits:11', 'regex:/(09)[0-9]{9}/'],
//            'discount_code' => 'nullable',
        ]);

        // auth user to site and don't log out user
        $user = User::where('mobile', $validated['mobile'])->first();
        if(!$user) {
            $user = User::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
            ]);

            event(new Registered($user));
        }
        Auth::login($user, true);

        $course = Course::find(2);
        $course_price = '790000';
//        $course_price = '1000';
//        if(!empty($validated['discount_code']) && $validated['discount_code'] == 'qPU26i5nHD') {
//            $course_price = '390000';
//        }
        $cart = [
            'price' => $course_price,
            'total_discount_price' => '0',
            'items' => [
                $course->id => [
                    'name' => $course->name,
                    'price' => $course->price,
                    'discount_percent' => $course->discount_percent ?: 0,
                    'discount_price' => $course->discount_percent ? ($course->price*$course->discount_percent/100) : 0,
                    'image' => $course->get_cover()
                ]
            ]
        ];
        session()->put('cart', $cart);

        return redirect('panel/payments/create');
    }


    public function showFandoghDress() {
        return view('web.direct_links.both');
    }

    public function purchaseFandoghDress(Request $request) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'between:3,255'],
            'mobile' => ['required', 'numeric', 'digits:11', 'regex:/(09)[0-9]{9}/'],
        ]);

        // auth user to site and don't log out user
        $user = User::where('mobile', $validated['mobile'])->first();
        if(!$user) {
            $user = User::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
            ]);

            event(new Registered($user));
        }
        Auth::login($user, true);

        $course1 = Course::find(1);
        $course2 = Course::find(2);
        $course_price = '1490000';
        $cart = [
            'price' => $course_price,
            'total_discount_price' => '0',
            'items' => [
                $course1->id => [
                    'name' => $course1->name,
                    'price' => $course1->price,
                    'discount_percent' => $course1->discount_percent ?: 0,
                    'discount_price' => $course1->discount_percent ? ($course1->price*$course1->discount_percent/100) : 0,
                    'image' => $course1->get_cover()
                ],
                $course2->id => [
                    'name' => $course2->name,
                    'price' => $course2->price,
                    'discount_percent' => $course2->discount_percent ?: 0,
                    'discount_price' => $course2->discount_percent ? ($course2->price*$course2->discount_percent/100) : 0,
                    'image' => $course2->get_cover()
                ]
            ]
        ];
        session()->put('cart', $cart);

        return redirect('panel/payments/create');
    }

//    public function buyDollClothesCourseByCart(Request $request) {
//        $validated = $request->validate([
//            'full_name' => 'required|string',
//            'phone' => ['required', 'numeric', 'regex:/09[0-9]{9}/'],
//            'tracking_code' => 'required|integer',
//            'card_number' => 'required|integer',
//            'paid_date' => 'required|string',
//            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:4096',
//            'description' => 'nullable|string',
//        ]);
//
//        $cart_payment = CartPayment::create($validated);
//        if(!empty($validated['image'])) {
//            $cart_payment->payment_image = $cart_payment->id . '.' . $validated['image']->extension();
//            $cart_payment->save();
//            $validated['image']->storeAs('/cart_payments/', $cart_payment->payment_image, 'public_media');
//        }
//
//        return back()->with([
//            'status' => 'success',
//            'message' => 'اطلاعات پرداخت شما با موفقیت ثبت شد، لطفا به پشیبان سایت پیام بدین.',
//        ]);
//    }
}
