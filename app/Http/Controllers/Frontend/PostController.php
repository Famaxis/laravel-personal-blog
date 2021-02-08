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
            ->paginate(5)
            ->onEachSide(1);

        return view('frontend.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // optimizing queries number
        if($post->tagNames())  {
            $tags = Post::existingTags()->pluck('name');
        } else {
            $tags = [];
        }

        $next = Post::where('id', '>', $post->id)
            ->where('is_published', 1)
            ->oldest('id')
            ->first();
        $prev = Post::where('id', '<', $post->id)
            ->where('is_published', 1)
            ->latest('id')
            ->first();

        return view('frontend.posts.single', compact('post','next', 'prev', 'tags'));
    }

    public function fetchByTag(Tag $tag)
    {
        $slug = $tag->slug;
        $posts = Post::withAnyTag([$slug])
            ->orderBy('created_at', 'desc')
            ->with('tagged')
            ->paginate(5);

        return view('frontend.posts.index', compact('posts','tag'));
    }
}
