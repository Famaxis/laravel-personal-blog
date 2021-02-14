<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Inspections\Antispam;
use App\Models\Comment;
use App\Services\CommentHandler;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        // comment frequency limiter, no restrictions for admin
        $this->middleware('throttle:2,1')->except('storeForAdmin');
    }

    // for guests
    public function store(CommentRequest $request, $post)
    {
        $comment = new Comment;

        // honeypot for spamers
        if ($request->filled('email') || $request->filled('website')) {
            return redirect()->route('front.posts');
        }

        if (Antispam::detect(
            request('comment'),
            request('name')
        )) {
            return redirect()->route('front.posts');
        }

        $comment->name = CommentHandler::setDefaultNickname(request('name'));
        $comment->comment = strip_tags($request->comment);
        $comment->post_id = $post;
        // guest doesn't have user_id
        $comment->user_id = null;
        $comment->save();

        return redirect()->back();
    }

    // for admin, without antispam and validation
    public function storeForAdmin(Request $request, $post)
    {
        $comment = new Comment;

        // admin already has nickname
        $comment->name = null;
        $comment->comment = $request->comment;
        $comment->post_id = $post;
        $comment->user()->associate($request->user());
        $comment->save();

        return redirect()->back();
    }
}
