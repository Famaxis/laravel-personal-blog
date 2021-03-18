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
        Comment::create([
            'name'    => CommentHandler::setDefaultNickname($request->name),
            'comment' => strip_tags($request->comment),
            'post_id' => $post,
            // guest doesn't have user_id
            'user_id' => null,
        ]);

        return redirect(url()->previous() . '#comments');
    }

    // for admin, without antispam and validation
    public function storeForAdmin(Request $request, $post)
    {
        Comment::create([
            // admin already has nickname
            'name'    => null,
            'comment' => $request->comment,
            'post_id' => $post,
            'user_id' => $request->user()->id,
        ]);

        return redirect(url()->previous() . '#comments');
    }
}
