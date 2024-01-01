<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckingController extends Controller
{
    /**
     * Display the checking view.
     */
    public function create(): View
    {
        return view('auth.checking');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'mobile' => ['required', 'numeric', 'digits:11', 'regex:/(09)[0-9]{9}/']
        ]);
        $mobile = $request->mobile;

        $user = User::where('mobile', $mobile)->first();
        if (empty($user)) {
            return redirect('/register')->with(['mobile' => $mobile]);
        } else {
            $with_pass = !empty($user->password);
            return redirect('/login')->with(['mobile' => $mobile, 'with_pass' => $with_pass]);
        }
    }
}
