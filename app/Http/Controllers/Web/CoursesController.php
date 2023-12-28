<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index() {
        $data['breadcrumbs'] = [
            ['title' => 'صفحه اصلی', 'link' => '/'],
            ['title' => 'جستجو'],
        ];

        $data['courses'] = Course::where('status', '<>', 'inactive')->orderByDesc('order')->get();
        return view('web.courses.index', $data);
    }

    public function myCourses(Request $request) {
        $user = auth()->user();
        $data['user'] = $user;
        $data['courses'] = $user->courses;

        return view('web.panel.courses.index', $data);
    }

    public function show(Course $course): View
    {
        if($course->status == 'inactive') {
            return abort(403);
        }

        $course->increment('views_count');

        $data['breadcrumbs'] = [
            ['title' => 'صفحه اصلی', 'link' => '/'],
            ['title' => 'دوره ها', 'link' => '/courses'],
            ['title' => $course->name],
        ];

        $data['course'] = $course;
        $data['comments'] = $course->comments()
            ->where('status', 'active')
            ->whereNull('parent_id')
            ->get();
        return view('web.courses.show', $data);
    }
}
