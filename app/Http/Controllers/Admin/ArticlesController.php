<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    public function create()
    {
        $data['sidebar_item'] = 'articles_create';
        $data['title'] = 'ثبت مقاله';
        return view('admin.articles.form', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5',
            'order' => 'nullable|integer|min:1',
            'status' => 'nullable|string|in:active,inactive',
            'difficulty_level' => 'nullable|string|in:beginner,intermediate,advanced',
            'tags' => 'required|string',
            'estimated_time' => 'required|integer',
            'abstract' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg|max:2048', // 2MB
            'video' => 'nullable|file|mimes:mp4|max:65536', // 10MB
        ]);

        $validated['user_id'] = auth()->id();

        if($article = Article::create($validated)) {
            $this->store_media($validated, $article);

            $article->save();

            return redirect('/admin')->with([
                'status' => 'success',
                'message' => 'مقاله با موفقیت ثبت شد.',
            ]);
        }

        return back();
    }

    /**
     * @param array $validated
     * @param $article
     * @return void
     */
    private function store_media(array $validated, $article): void
    {
        if (!empty($validated['video'])) {
            $article->has_video = true;
            $validated['video']->storeAs('/articles/' . $article->id, 'video.mp4', 'public_media');
        } elseif (!empty($validated['image'])) {
            $article->has_image = true;
            $validated['image']->storeAs('/articles/' . $article->id, 'image.jpg', 'public_media');
        }
    }

    public function uploadImage(Request $request)
    {
        // Check if the request has a file
        if ($request->hasFile('upload')) {
            // Validate the file type
            $request->validate([
                'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            // Store the file and get its path
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->storeAs('/article_uploads', $fileName, 'public_media');

            $url = asset('media/article_uploads/' . $fileName);
            return response()->json([
                'uploaded' => true,
                'url' => $url,
                'fileName' => $fileName,
            ]);
        }

        // در صورت وجود خطا
        return response()->json([
            'uploaded' => false,
            'error' => ['message' => 'File upload failed.']
        ], 400);
    }
}