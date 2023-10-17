<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class CoursesController extends Controller
{
    public function index() {
        $data['breadcrumbs'] = [
            ['title' => 'صفحه اصلی', 'link' => '/'],
            ['title' => 'جستجو'],
        ];

        $data['courses'] = Course::where('status', '<>', 'inactive')->get();
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
        return view('web.courses.show', $data);
    }

    public function show_lessons(Course $course, Lesson $lesson): View
    {
        if(!auth()->user()->is_my_course($course)) {
            return abort(403);
        }

        $data['breadcrumbs'] = [
            ['title' => 'صفحه اصلی', 'link' => '/'],
            ['title' => 'دوره ها', 'link' => '/courses'],
            ['title' => $course->name, 'link' => $course->get_url()],
            ['title' => $lesson->title],
        ];

        $data['course'] = $course;
        $data['lesson'] = $lesson;

        return view('web.panel.lessons.show', $data);
    }

    public function download(Course $course, Lesson $lesson)
    {
        if(!auth()->user()->is_my_course($course)) {
            return abort(403);
        }
        return Response::download($lesson->download_url());
    }

    public function toggle_complete(Course $course, Lesson $lesson): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $lesson->is_complete = !$lesson->is_complete;
        $lesson->save();

        return back()->withInput();
    }
}
