<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Conner\Tagging\Model\Tag;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', 1)
            ->with('tagged')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('frontend.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $tags = Post::existingTags()->pluck('name');

        return view('frontend.posts.single')
            ->with(compact('post'))
            ->with(compact('tags'));
    }

    public function fetchByTag(Tag $tag)
    {
        $slug = $tag->slug;
        $posts = Post::withAnyTag([$slug])
            ->orderBy('created_at', 'desc')
            ->with('tagged')
            ->paginate(5);

        return view('frontend.posts.index')
            ->with(compact('posts'))
            ->with(compact('tag'));
    }
}