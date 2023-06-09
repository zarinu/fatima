<?php

namespace App\Http\Controllers;

use App\Models\Course;
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
}
