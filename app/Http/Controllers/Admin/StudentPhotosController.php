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

        $new_image = Image::make($validated['image']);
        $new_width = 600;
        $new_height = 800;
        $width = $new_image->width();
        $height = $new_image->height();
        $vertical = $width < $height;
        $horizontal = $width > $height;
        $square = ($width == $height);
        if ($vertical) {
            $new_image->resize(null, $new_height, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else if ($horizontal or $square) {
            $new_image->resize($new_width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $new_image->resizeCanvas($new_width, $new_height, 'center', false, '#ffffff');

        $new_image->resize($new_width, $new_height);

        // insert a watermark
        $watermark = Image::make(public_path('/assets/images/hani_logo.png'));
        $watermark->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $new_image->insert($watermark, 'top-right', 10, 10);

        $new_image->save(public_path('media/student_photos/' . $student_photo->id . '.jpg'));
        return redirect('/admin/student-photos')->with([
            'status' => 'success',
            'message' => 'تصویر هنرجو با موفقیت ثبت شد.',
        ]);
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
