<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verification;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function send_code(Request $request): RedirectResponse
    {
        $request->validate([
            'mobile' => ['required', 'numeric', 'digits:11', 'regex:/(09)[0-9]{9}/', 'exists:'.User::class],
        ], ['exists' => 'شما قبلا با این شماره موبایل ثبت نام نکرده اید، لطفا ابتدا از لینک زیر ثبت نام کنید.',
            'numeric' => 'لطفا از اعداد انگلیسی استفاده کنید.']);
        $mobile = $request->mobile;

        $verification = Verification::create([
            'mobile' => $mobile,
            'code' => rand(1000, 9999),
            'action' => 'forgot_password',
            'expired_at' => Carbon::now()->addMinute(),
        ]);

        $verification->send_code();

        return redirect()->route('check_code.request', ['mobile' => $mobile]);
    }
}
