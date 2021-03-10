<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->paginate(5);
        return view('backend.comments.index', compact('comments'));
    }

    public function edit(Comment $comment)
    {
        return view('backend.comments.edit', compact('comment'));
    }

    public function update(Comment $comment)
    {
        $comment->update([
            'comment' => request('comment'),
        ]);
        return redirect()->route('comments');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
