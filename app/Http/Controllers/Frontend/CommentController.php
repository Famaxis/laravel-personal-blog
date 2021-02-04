<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request, $post)
    {
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->name = $request->name;
        $comment->post_id = $post;
        $comment->user()->associate($request->user());
        $comment->save();

        return redirect()->back();
    }
}
