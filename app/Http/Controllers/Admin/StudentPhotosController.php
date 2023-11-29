<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentPhoto;
use Image;
use Illuminate\Http\Request;

class StudentPhotosController extends Controller
{
    public function index()
    {
        $data['sidebar_item'] = 'student_photos';
        $data['student_photos'] = StudentPhoto::all();
        return view('admin.student_photos.index', $data);
    }

    public function create()
    {
        $data['sidebar_item'] = 'student_photos_create';
        $data['title'] = 'ثبت عکس هنرجو';
        return view('admin.student_photos.form', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'course_id' => 'nullable|integer',
            'order' => 'nullable|integer',
            'image' => 'required|image|mimes:jpg|max:2048',
        ]);

        $student_photo = StudentPhoto::create($validated);

        if($student_photo) {
            $new_image = Image::make($validated['image']);
            $new_width= 600;
            $new_height= 800;
            $new_image->resize($new_width, $new_height);
            $new_image->save(public_path('media/student_photos/' . $student_photo->id . '.jpg'));

            return redirect('/admin/student-photos')->with([
                'status' => 'success',
                'message' => 'تصویر هنرجو با موفقیت ثبت شد.',
            ]);
        }
    }

    public function delete(StudentPhoto $student_photo)
    {
        $student_photo->delete();
        return redirect('/admin/student-photos')->with([
            'status' => 'success',
            'message' => 'تصویر هنرجو با موفقیت حذف شد.',
        ]);
    }
}
