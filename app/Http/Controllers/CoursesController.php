<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Contracts\View\View;


class CoursesController extends Controller
{
    public function index() {
        //
    }

    public function show(Course $course): View
    {
        return view('courses.show', ['course' => $course]);
    }

    public function show_lessons(Course $course, Lesson $lesson): View
    {
        return view('lessons.show', ['course' => $course, 'lesson' => $lesson]);
    }

    public function toggle_complete(Course $course, Lesson $lesson): View
    {
        $lesson->is_complete = !$lesson->is_complete;
        $lesson->save();

        return view('lessons.show', ['course' => $course, 'lesson' => $lesson]);
    }
}
