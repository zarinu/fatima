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

//    public function create()
//    {
//        $data['sidebar_item'] = 'comments_create';
//        $data['title'] = 'ثبت دیدگاه';
//        return view('admin.comments.form', $data);
//    }
//
//    public function store(Request $request)
//    {
//        $validated = $request->validate([
//            'user_id' => 'nullable|integer',
//            'code' => 'required|string|between:3,10',
//            'type' => 'required|in:percentage,numeric',
//            'value' => 'required|integer',
//            'count' => 'nullable|integer',
//            'start_at' => 'required|date',
//            'expire_at' => 'required|date',
//        ]);
//
//        Comment::create($validated);
//
//        return redirect('/admin/comments')->with([
//            'status' => 'success',
//            'message' => 'دیدگاه با موفقیت ثبت شد.',
//        ]);
//    }
//
//    public function edit(Comment $discount)
//    {
//        $data['sidebar_item'] = 'comments_create';
//        $data['title'] = 'ویرایش دیدگاه شماره ' . $discount->id . '#';
//        $data['discount'] = $discount;
//        return view('admin.comments.form', $data);
//    }
//
//    public function update(Request $request, Comment $discount)
//    {
//        $validated = $request->validate([
//            'user_id' => 'nullable|integer',
//            'code' => 'required|string|between:3,10',
//            'type' => 'required|in:percentage,numeric',
//            'value' => 'required|integer',
//            'count' => 'required|integer',
//            'start_at' => 'required|date',
//            'expire_at' => 'required|date',
//        ]);
//
//        $discount->fill($validated)->save();
//
//        return redirect('/admin/comments')->with([
//            'status' => 'success',
//            'message' => 'دیدگاه با موفقیت ویرایش شد.',
//        ]);
//    }
//
//    public function delete(Comment $discount)
//    {
//        $discount->delete();
//        return redirect('/admin/comments')->with([
//            'status' => 'success',
//            'message' => 'دیدگاه با موفقیت حذف شد.',
//        ]);
//    }
}
