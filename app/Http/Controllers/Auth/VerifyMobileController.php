<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verification;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyMobileController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function enter_code(Request $request)
    {
        if(empty($request->mobile)) {
            return redirect()->route('password.request');
        }
        return view('auth.check-code', ['mobile' => $request->mobile]);
    }

    /**
     * @throws ValidationException
     */
    public function check_code(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        if(empty($request->mobile)) {
            return redirect()->route('password.request');
        }
        $mobile = $request->mobile;
        $request->validate([
            'verify_code' => ['required', 'integer', 'digits:4', 'exists:verifications,code,mobile,'.$mobile.',action,forgot_password,verified_at,NULL'],
        ]);

        $verification = Verification::where([
            'code' => $request->verify_code,
            'mobile' => $mobile,
            'action' => 'forgot_password',
            'verified_at' => NULL,
        ])->first();
        if($verification->expired_at < Carbon::now()) {
            throw ValidationException::withMessages(['verify_code' => 'کد تایید منقضی شده است، لطفا مجدد نسبت به دریافت کد یکبار مصرف اقدام کنید.']);
        }

        $verification->verified_at = Carbon::now();
        $verification->save();

        $user = User::where('mobile', $mobile)->first();

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
