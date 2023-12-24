<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirectLinksController extends Controller
{
    public function getBuyDollClothesCourse() {
        return view('web.direct-link');
    }

    public function buyDollClothesCourse(Request $request) {
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

        $course = Course::find(1);
        $cart = [
            'price' => '490000',
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
}
