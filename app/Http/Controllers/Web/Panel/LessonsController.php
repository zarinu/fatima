<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Response;

class LessonsController extends Controller
{
    public function show(Course $course, Lesson $lesson): View
    {
        if(!auth()->user()->is_my_course($course)) {
            return abort(403);
        }

        $data['breadcrumbs'] = [
            ['title' => 'صفحه اصلی', 'link' => '/'],
            ['title' => 'دوره ها', 'link' => '/courses'],
            ['title' => $course->name, 'link' => route('courses.show', ['course' => $course->id])],
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
        return Response::download($lesson->get_url());
    }

//    public function toggle_complete(Course $course, Lesson $lesson): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
//    {
//        $lesson->is_complete = !$lesson->is_complete;
//        $lesson->save();
//
//        return back()->withInput();
//    }
}
