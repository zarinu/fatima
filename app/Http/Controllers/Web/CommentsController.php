<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Course;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'parent_id' => 'nullable|integer',
            'name' => 'required|string',
            'mobile' => ['nullable', 'numeric', 'digits:11', 'regex:/(09)[0-9]{9}/'],
            'item_id' => 'required|integer',
            'content' => 'required|string',
            'rate' => 'required|integer|between:1,5',
        ]);

        $validated['user_id'] = auth()->check() ? auth()->id() : null;
        $validated['item'] = 'course';

        Comment::create($validated);

        $course = Course::find($validated['item_id']);

        $course->increment('score');
        $course->rate = (($course->rate * ($course->score - 1)) + $validated['rate']) / $course->score;
        $course->save();

        return back()->with([
            'status' => 'success',
            'message' => 'نظر شما با موفقیت ثبت شد و پس از تایید در سایت نمایش داده خواهد شد.',
        ]);
    }

    public function like(Comment $comment) {
        if(session('comment' . $comment->id . '-liked')) {
            return back();
        }
        $comment->increment('likes');
        session()->put('comment' . $comment->id . '-liked', true);

        return back()->with([
            'status' => 'success',
            'message' => 'بازخورد شما ثبت شد.'
        ]);
    }

    public function dislike(Comment $comment) {
        if(session('comment' . $comment->id . '-liked')) {
            return back();
        }
        $comment->increment('dislikes');
        session()->put('comment' . $comment->id . '-liked', true);

        return back()->with([
            'status' => 'success',
            'message' => 'بازخورد شما ثبت شد.'
        ]);
    }
}
