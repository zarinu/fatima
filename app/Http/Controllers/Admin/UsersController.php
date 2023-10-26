<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $data['sidebar_item'] = 'users';
        $data['users'] = User::where('role_id', 2)->get();
        return view('admin.users.index', $data);
    }

    public function create()
    {
        $data['sidebar_item'] = 'users_create';
        $data['title'] = 'ثبت کاربر';
        return view('admin.users.form', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'mobile' => ['required', 'numeric', 'regex:/09[0-9]{9}/', 'unique:users'],
            'password' => 'nullable|string|min:6',
        ], ['mobile.numeric' => 'اعداد موبایل را انگلیسی وارد کنید.']);

        if(empty($validated['password'])) {
            $validated['password'] = 123456789;
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect('/admin/users')->with([
            'status' => 'success',
            'message' => 'کاربر با موفقیت ثبت شد.',
        ]);
    }

    public function edit(User $user)
    {
        $data['sidebar_item'] = 'users_create';
        $data['title'] = 'ویرایش کاربر ' . $user->name;
        $data['user'] = $user;
        return view('admin.users.form', $data);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'mobile' => ['required', 'numeric', 'regex:/09[0-9]{9}/', 'unique:users'],
            'password' => 'nullable|string|min:6',
        ], ['mobile.numeric' => 'اعداد موبایل را انگلیسی وارد کنید.']);

        if(!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->fill($validated);
        $user->save();

        return redirect('/admin/users/'. $user->id . '/edit')->with([
            'status' => 'success',
            'message' => 'کاربر با موفقیت ویرایش شد.',
        ]);
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect('/admin/users')->with([
            'status' => 'success',
            'message' => 'کاربر با موفقیت حذف شد.',
        ]);
    }
}
