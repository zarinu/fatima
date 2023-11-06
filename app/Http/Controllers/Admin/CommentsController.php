<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Request $request)
    {
        $data['sidebar_item'] = 'comments';
        $comments = Comment::query();
        if(!empty($request->status)) {
            $comments->where('status', $request->status);
        }
        $data['comments'] = $comments->get();
        return view('admin.comments.index', $data);
    }

    public function activate(Comment $comment) {
        $comment->status = 'active';
        $comment->save();

        return back()->with([
            'status' => 'success',
            'message' => 'نظر با موفقیت فعال گردید.',
        ]);
    }

    public function inactivate(Comment $comment) {
        $comment->status = 'inactive';
        $comment->save();

        return back()->with([
            'status' => 'success',
            'message' => 'نظر با موفقیت غیرفعال گردید.',
        ]);
    }

    public function edit(Comment $comment)
    {
        $data['sidebar_item'] = 'comments';
        $data['title'] = 'ویرایش دیدگاه شماره ' . $comment->id . '#';
        $data['comment'] = $comment;
        return view('admin.comments.form', $data);
    }

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $comment->fill($validated)->save();

        return redirect('/admin/comments')->with([
            'status' => 'success',
            'message' => 'دیدگاه با موفقیت ویرایش شد.',
        ]);
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect('/admin/comments')->with([
            'status' => 'success',
            'message' => 'دیدگاه با موفقیت حذف شد.',
        ]);
    }
}
