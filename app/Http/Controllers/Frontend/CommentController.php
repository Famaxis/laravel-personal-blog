<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use App\Inspections\Antispam;
use App\Services\CommentHandler;

class CommentController extends Controller
{
    private $antispam;
    private $commentHandler;

    public function __construct(Antispam $antispam, CommentHandler $commentHandler)
    {
        // comment frequency limiter
        $this->middleware('throttle:5,1');

        $this->antispam = $antispam;
        $this->commentHandler = $commentHandler;
    }

    public function store(CommentRequest $request, $post)
    {
        $comment = new Comment;

        if ($this->antispam->detect(
            request('comment'),
            request('name')
        )) {
            return redirect()->back();
        }

        $comment->name = $this->commentHandler->setDefaultNickname(request('name'));

        $comment->comment = strip_tags($request->comment);
        $comment->post_id = $post;
        $comment->user()->associate($request->user());
        $comment->save();

        return redirect()->back();
    }
}
