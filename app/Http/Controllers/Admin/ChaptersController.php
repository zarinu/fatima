<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Chapter;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ChaptersController extends Controller
{
    public function index(Course $course)
    {
        $data['sidebar_item'] = 'courses';
        $data['chapters'] = $course->chapters()->orderBy('order')->get();
        $data['course'] = $course;
        $data['title'] = 'سرفصلهای ' . $course->name;
        return view('admin.chapters.index', $data);
    }

    public function create(Course $course)
    {
        $data['sidebar_item'] = 'courses';
        $data['title'] = 'ایجاد سرفصل برای ' . $course->name;
        $data['course'] = $course;
        return view('admin.chapters.form', $data);
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'order' => 'nullable|integer',
        ]);

        $validated['course_id'] = $course->id;

        Chapter::create($validated);

        return redirect('/admin/courses/' . $course->id . '/chapters')->with([
            'status' => 'success',
            'message' => 'سرفصل با موفقیت اضافه شد.',
        ]);
    }

    public function edit(Course $course, Chapter $chapter)
    {
        $data['sidebar_item'] = 'courses';
        $data['title'] = 'ویرایش سرفصل دوره ' . $course->name;
        $data['course'] = $course;
        $data['chapter'] = $chapter;
        return view('admin.chapters.form', $data);
    }

    public function update(Request $request, Course $course, Chapter $chapter)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'order' => 'nullable|integer',
        ]);

        $chapter->fill($validated);
        $chapter->save();

        return redirect('/admin/courses/' . $course->id . '/chapters')->with([
            'status' => 'success',
            'message' => 'سرفصل با موفقیت ویرایش شد.',
        ]);
    }

    public function delete(Course $course, Chapter $chapter)
    {
        foreach ($chapter->lessons as $lesson) {
            if (File::exists(public_path($lesson->get_url()))){
                File::delete(public_path($lesson->get_url()));
            }
            $lesson->delete();
        }
        $chapter->delete();

        return redirect('/admin/courses/' . $course->id . '/chapters')->with([
            'status' => 'success',
            'message' => 'سرفصل با موفقیت حذف شد.',
        ]);
    }
}
