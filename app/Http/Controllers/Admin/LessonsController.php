<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonImage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Image;

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
            'lesson_images' => 'nullable|array',
            'lesson_images.*.caption' => 'nullable|string|max:255',
            'lesson_images.*.content' => 'required|file|mimes:png,jpeg,jpg|max:8192',
        ]);

        $validated['course_id'] = $course->id;

        if($lesson = Lesson::create($validated)) {
            $course->increment('uploaded_count');

            if(!empty($validated['content'])) {
                $content_path = generateRandomString() . '.' . $validated['content']->extension();
                $lesson->content_path = $content_path;
                $validated['content']->move(public_path('media/courses/'. $course->id), $content_path);
            }

            $this->store_lesson_images($validated, $course, $lesson);

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
            'lesson_images' => 'nullable|array',
            'lesson_images.*.caption' => 'nullable|string|max:255',
            'lesson_images.*.content' => 'required|file|mimes:png,jpeg,jpg|max:8192',
        ]);

        if(!empty($validated['content'])) {
            if(!empty($lesson->content_path)) {
                if (File::exists(public_path($lesson->get_url()))){
                    File::delete(public_path($lesson->get_url()));
                }
            }
            $content_path = generateRandomString() . '.' . $validated['content']->extension();
            $lesson->content_path = $content_path;
            $validated['content']->move(public_path('media/courses/'. $course->id), $content_path);
        }

        $this->store_lesson_images($validated, $course, $lesson);

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

        $lesson->course->decrement('uploaded_count');
        $lesson->delete();

        return redirect('/admin/courses/' . $course->id . '/lessons')->with([
            'status' => 'success',
            'message' => 'درس با موفقیت حذف شد.',
        ]);
    }

    /**
     * @param array $validated
     * @param Course $course
     * @param Lesson $lesson
     */
    private function store_lesson_images(array $validated, Course $course, Lesson $lesson)
    {
        if (!empty($validated['lesson_images'])) {
            foreach ($validated['lesson_images'] as $lesson_image) {
                $image_path = generateRandomString() . '.' . $lesson_image['content']->extension();
                $new_image = Image::make($lesson_image['content']);
                $new_width= 600;
                $new_height= 800;

                $width  = $new_image->width();
                $height = $new_image->height();

                $vertical   = $width < $height;
                $horizontal = $width > $height;
                $square     = (bool)(($width = $height));

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

                $base_path = public_path('media/courses/' . $course->id . '/lesson_images');
                if(!File::isDirectory($base_path)) {
                    File::makeDirectory($base_path);
                }
                $new_image->save($base_path . '/' . $image_path);

                LessonImage::create([
                    'course_id' => $course->id,
                    'lesson_id' => $lesson->id,
                    'caption' => $lesson_image['caption'],
                    'image_path' => $image_path,
                ]);
            }
        }
    }
}
