<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    public function index(Course $course)
    {
        $data['sidebar_item'] = 'courses';
        $data['lessons'] = $course->lessons()
            ->orderBy('chapter_id')
            ->orderBy('order')
            ->get();
        $data['course'] = $course;
        $data['title'] = 'دروس ' . $course->name;
        return view('admin.lessons.index', $data);
    }

    public function create(Course $course)
    {
        $data['sidebar_item'] = 'courses';
        $data['title'] = 'ایجاد درس برای ' . $course->name;
        $data['course'] = $course;
        return view('admin.lessons.form', $data);
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5',
            'order' => 'nullable|integer',
            'chapter_id' => 'required|integer',
            'description' => 'nullable|string',
            'type' => 'nullable|in:video,audio,image,file',
            'content' => 'nullable|file|mimes:mp4,mp3,png,jpg,jpeg,pdf|max:1048576',
        ]);

        $validated['course_id'] = $course->id;

        if($lesson = Lesson::create($validated)) {
            $course->increment('uploaded_count');

            if(!empty($validated['content'])) {
                $content_path = generateRandomString() . '.mp4';
                $lesson->content_path = $content_path;
                $validated['content']->move(public_path('media/courses/'. $course->id), $content_path);
            }

            if($course->lessons()->count() > 1) {
                $previous_lesson = $course->lessons()->whereNull('next_lesson_id')->first();
                $lesson->previous_lesson_id = $previous_lesson->id;
                $previous_lesson->next_lesson_id = $lesson->id;
                $previous_lesson->save();
            }

            $lesson->save();

            return redirect('/admin/courses/' . $course->id . '/lessons')->with([
                'status' => 'success',
                'message' => 'درس با موفقیت اضافه شد.',
            ]);
        }

        return back();
    }

    public function edit(Course $course, Lesson $lesson)
    {
        $data['sidebar_item'] = 'courses';
        $data['title'] = 'ویرایش درس دوره ' . $course->name;
        $data['course'] = $course;
        $data['lesson'] = $lesson;
        return view('admin.lessons.form', $data);
    }

    public function update(Request $request, Course $course, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5',
            'order' => 'nullable|integer',
            'chapter_id' => 'required|integer',
            'description' => 'nullable|string',
            'type' => 'nullable|in:video,audio,image,file',
            'content' => 'nullable|file|mimes:mp4,mp3,png,jpg,jpeg,pdf|max:1048576',
        ]);

        if(!empty($validated['content'])) {
            if(!empty($lesson->content_path)) {
                if (File::exists(public_path($lesson->get_url()))){
                    File::delete(public_path($lesson->get_url()));
                }
            }
            $content_path = generateRandomString() . '.mp4';
            $lesson->content_path = $content_path;
            $validated['content']->move(public_path('media/courses/'. $course->id), $content_path);
        }

        $lesson->fill($validated);
        $lesson->save();

        return redirect('/admin/courses/' . $course->id . '/lessons')->with([
            'status' => 'success',
            'message' => 'درس با موفقیت ویرایش شد.',
        ]);
    }

    public function delete(Course $course, Lesson $lesson)
    {
        if (!empty($lesson->content_path) && File::exists(public_path($lesson->get_url()))){
            File::delete(public_path($lesson->get_url()));
        }

        // change the previous and next lesson
        if($lesson->previousLesson) {
            if($lesson->nextLesson) {
                $lesson->previousLesson->next_lesson_id = $lesson->nextLesson->id;
            } else {
                $lesson->previousLesson->next_lesson_id = null;
            }

            $lesson->previousLesson->save();
        }
        if($lesson->nextLesson) {
            if($lesson->previousLesson) {
                $lesson->nextLesson->previous_lesson_id = $lesson->previousLesson->id;
            } else {
                $lesson->nextLesson->previous_lesson_id = null;
            }

            $lesson->nextLesson->save();
        }

        $lesson->delete();

        return redirect('/admin/courses/' . $course->id . '/lessons')->with([
            'status' => 'success',
            'message' => 'درس با موفقیت حذف شد.',
        ]);
    }
}
