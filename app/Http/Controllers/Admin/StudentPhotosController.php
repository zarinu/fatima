<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentPhoto;
use Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StudentPhotosController extends Controller
{
    public function index()
    {
        $data['sidebar_item'] = 'student_photos';
        return view('admin.student_photos.index', $data);
    }

    public function grid(Request $request)
    {
        if($request->ajax()){
            $data = StudentPhoto::query()->orderBy('order');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '<a href="/admin/student-photos/'.$row->id.'/delete" class="delete btn btn-danger btn-sm mt-1" onclick="return confirm(`واقعا میخوای این عکس رو حذف کنی؟`)">حذف</a>';
                })
                ->addColumn('image', function($row){
                    return '<img class="img-thumbnail elevation-2" width="50px" height="50px" src="' . $row->photo(). '">';
                })
                ->addColumn('order', function($row){
                    return
                        '<form method="GET" action="/admin/student-photos/'.$row->id.'/update-order">'.
                        '<div class="row">'.
                        '<div class="col"><input type="number" class="form-control" name="order" value="'.$row->order.'"></div>'.
                        '<div><input class="btn btn-outline-info btn-sm mt-1" type="submit" value="ثبت" /></div>'.
                        '</div>'.
                        '</form>';
                })
                ->editColumn('course_id', function ($row) {
                    return !empty($row->course) ? $row->course->name : 'نامشخص';
                })
                ->editColumn('title', function ($row) {
                    return $row->title ?: 'بدون عنوان';
                })
                ->rawColumns(['action', 'image', 'order'])
                ->make(true);
        }
        return view('admin.users.index');
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

    public function updateOrder(Request $request, StudentPhoto $student_photo)
    {
        $validated = $request->validate([
            'order' => 'required|integer',
        ]);

        $student_photo->order = $validated['order'];
        $student_photo->save();

        return redirect('/admin/student-photos')->with([
            'status' => 'success',
            'message' => 'اولویت تصاویر هنرجویان با موفقیت تغییر کرد.',
        ]);
    }

    public function delete(StudentPhoto $student_photo) {
        $student_photo->delete();
        return redirect('/admin/student-photos')->with([
            'status' => 'success',
            'message' => 'تصویر هنرجو با موفقیت حذف شد.',
        ]);
    }
}
