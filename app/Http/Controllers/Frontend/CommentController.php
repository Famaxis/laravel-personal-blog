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
        $this->middleware('throttle:1,1')->except('storeForAdmin');
    }

    // for guests
    public function store(CommentRequest $request, $resource)
    {
        // honeypot for spamers, this fields must be hidden in css with "opacity: 0"
        if ($request->filled('email') || $request->filled('website')) {
            return redirect()->route('front.posts');
        }

        // antispam checking
        if (Antispam::detect(
            $request->comment,
            $request->name
        )) {
            return redirect()->route('front.posts');
        }

        // if it's probably not spam, saving comment
        $comment = new Comment;

        $comment->name = CommentHandler::setDefaultNickname($request->name);
        $comment->comment = strip_tags($request->comment);
        $comment->post_id = $resource;
        // guest doesn't have user_id
        $comment->user_id = null;
        $comment->save();

        return redirect(url()->previous() . '#comments');
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

        return redirect(url()->previous() . '#comments');
    }
}
