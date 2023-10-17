<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserPanelController extends Controller
{
    public function dashboard(Request $request) {
        $data['user'] = auth()->user();
        return view('web.panel.dashboard.index', $data);
    }

    public function showProfile(Request $request) {
        $data['user'] = auth()->user();
        return view('web.panel.profile.edit', $data);
    }
}
