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
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function loginPage(Request $request)
    {
        if(empty(session('mobile'))) {
            return redirect('/checking');
        }
        $mobile = session('mobile');

        $has_verification = Verification::where('mobile', $mobile)->where('action', 'verify')->where('expired_at', '>=', date('Y-m-d H:i:s'))->first();
        if(!$has_verification) {
            $verification = Verification::create([
                'mobile' => $mobile,
                'code' => rand(1000, 9999),
                'action' => 'verify',
                'expired_at' => Carbon::now()->addMinute(),
            ]);

            $verification->send_code();
        }

        return view('auth.login', ['mobile' => $mobile, 'with_pass' => session('with_pass')]);
    }

    /**
     * Handle an incoming login request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request): RedirectResponse
    {
        if(empty($request->mobile)) {
            return redirect('checking');
        }
        $mobile = $request->mobile;
        session(['mobile' => $mobile]);

        $request->validate([
            'verify_code' => ['required', 'integer', 'digits:4', 'exists:verifications,code,action,verify,mobile,'.$mobile.',verified_at,NULL'],
        ]);

        $verification = Verification::where([
            'code' => $request->verify_code,
            'mobile' => $mobile,
            'action' => 'verify',
            'verified_at' => NULL,
        ])->first();

        if($verification->expired_at < Carbon::now()) {
            throw ValidationException::withMessages(['verify_code' => 'کد تایید منقضی شده است، لطفا مجدد نسبت به دریافت کد یکبار مصرف اقدام کنید.']);
        }

        $verification->verified_at = Carbon::now();
        $verification->save();

        $user = User::where('mobile', $request->mobile)->first();
        if(!$user->mobile_verified_at) {
            $user->mobile_verified_at = Carbon::now();
            $user->save();
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect(RouteServiceProvider::HOME);
    }

    public function loginPassPage(Request $request)
    {
        if(empty($request->mobile)) {
            return redirect('/checking');
        }
        $mobile = $request->mobile;

        return view('auth.login-pass', ['mobile' => $mobile]);
    }

    /**
     * Handle an incoming login request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function loginPass(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
