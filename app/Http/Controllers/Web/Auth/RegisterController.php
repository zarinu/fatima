<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verification;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request)
    {
        if(empty(session('mobile'))) {
            return redirect('/checking');
        }
        $mobile = session('mobile');

        $has_verification = Verification::where('mobile', $mobile)->where('action', 'verify')->where('expired_at', '>=', date('Y-m-d H:i:s'))->whereNull('verified_at')->first();
        if(!$has_verification) {
            $verification = Verification::create([
                'mobile' => $mobile,
                'code' => rand(1000, 9999),
                'action' => 'verify',
                'expired_at' => Carbon::now()->addMinute(),
            ]);

            $verification->send_code();
        }

        return view('auth.register', ['mobile' => $mobile]);
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        if(empty($request->mobile)) {
            return redirect('checking');
        }
        $mobile = $request->mobile;
        session(['mobile' => $mobile]);

        $request->validate([
            'verify_code' => ['required', 'integer', 'digits:4', 'exists:verifications,code,action,verify,mobile,'.$mobile.',verified_at,NULL'],
            'mobile' => ['required'],
        ]);

        $verification = Verification::where([
            'code' => $request->verify_code,
            'mobile' => $request->mobile,
            'action' => 'verify',
            'verified_at' => NULL,
        ])->first();

        if($verification->expired_at < Carbon::now()) {
            throw ValidationException::withMessages(['verify_code' => 'کد تایید منقضی شده است، لطفا مجدد نسبت به دریافت کد یکبار مصرف اقدام کنید.']);
        }

        $verification->verified_at = Carbon::now();
        $verification->save();

        $user = User::create([
            'mobile' => $request->mobile,
            'mobile_verified_at' => true,
        ]);

        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect('/enter-name');
    }

    public function enterName() {
        return view('auth.enter-name');
    }

    public function setName(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->save();

        return redirect(RouteServiceProvider::HOME);
    }
}
