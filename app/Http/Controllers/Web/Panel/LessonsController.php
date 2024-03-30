<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\UserViewedLesson;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
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

        $extension = File::extension('media/courses/' . $lesson->course->id . '/' . $lesson->content_path);
        $title = str_replace(' ', '_', $lesson->title) . '.' . $extension;
        return Response::download($lesson->get_url(), $title);
    }

    public function toggleComplete(Course $course, Lesson $lesson, bool $status)
    {
        UserViewedLesson::updateOrCreate([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
            'chapter_id' => $lesson->chapter->id,
            'lesson_id' => $lesson->id,
        ],
        [
            'is_complete' => $status,
        ]);

        return back()->with([
            'status' => 'success',
            'message' => ($status ? 'جلسه تکمیل شد.' : 'جلسه به عنوان کامل نشده علامت خورد.'),
        ]);
    }
}
