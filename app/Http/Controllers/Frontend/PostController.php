<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')
            ->with('tagged')
            ->paginate(5);
        return view('frontend.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('frontend.posts.single',compact('post'));
    }
}
