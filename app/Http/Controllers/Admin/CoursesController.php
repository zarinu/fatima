<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CoursesController extends Controller
{
    public function index()
    {
        $data['sidebar_item'] = 'courses';
        $data['courses'] = Course::all();
        return view('admin.courses.index', $data);
    }

    public function create()
    {
        $data['sidebar_item'] = 'courses_create';
        $data['title'] = 'ثبت دوره';
        return view('admin.courses.form', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'total_hours' => 'nullable|integer|min:1',
            'price' => 'nullable|integer',
            'discount_percent' => 'nullable|integer',
            'order' => 'nullable|integer',
            'status' => 'required|in:completed,pre-sell,presenting,not_for_sale,inactive',
            'summery' => 'nullable|string|between:150,200',
            'private_description' => 'nullable|string',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpg|max:2048', // 2MB
            'video' => 'nullable|file|mimes:mp4|max:65536', // 10MB
        ]);

        $validated['uploaded_count'] = 0;
        $validated['teacher_name'] = 'حانیه حیدری';
        $validated['user_id'] = auth()->id();

        if($course = Course::create($validated)) {
            $this->store_media($validated, $course);

            $course->save();

            return redirect('/admin/courses')->with([
                'status' => 'success',
                'message' => 'دوره با موفقیت ثبت شد.',
            ]);
        }

        return back();
    }

    public function edit(Course $course)
    {
        $data['sidebar_item'] = 'courses_create';
        $data['title'] = 'ویرایش ' . $course->name;
        $data['course'] = $course;
        return view('admin.courses.form', $data);
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'total_hours' => 'nullable|integer|min:1',
            'price' => 'nullable|integer',
            'discount_percent' => 'nullable|integer',
            'order' => 'nullable|integer',
            'status' => 'required|in:completed,pre-sell,presenting,not_for_sale,inactive',
            'summery' => 'nullable|string|between:150,200',
            'private_description' => 'nullable|string',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpg|max:2048', // 2MB
            'video' => 'nullable|file|mimes:mp4|max:65536', // 10MB
        ]);

        $this->store_media($validated, $course);

        $course->fill($validated);
        $course->save();

        return redirect('/admin/courses/' . $course->id . '/edit')->with([
            'status' => 'success',
            'message' => 'دوره با موفقیت ویرایش شد.',
        ]);
    }

    public function delete(Course $course)
    {
        $course->lessons()->delete();
        $course->chapters()->delete();
        File::deleteDirectory(public_path('/media/courses/' . $course->id));
        $course->delete();

        return redirect('/admin/courses')->with([
            'status' => 'success',
            'message' => 'دوره با موفقیت حذف شد.',
        ]);
    }

    /**
     * @param array $validated
     * @param $course
     * @return void
     */
    private function store_media(array $validated, $course): void
    {
        if (!empty($validated['video'])) {
            $course->has_video = true;
            $validated['video']->storeAs('/courses/' . $course->id, 'video.mp4', 'public_media');
        } elseif (!empty($validated['cover'])) {
            $course->has_cover = true;
            $validated['cover']->storeAs('/courses/' . $course->id, 'cover.jpg', 'public_media');
        }
    }
}
