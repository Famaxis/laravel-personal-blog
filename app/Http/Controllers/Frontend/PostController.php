<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Conner\Tagging\Model\Tag;

class PostController extends Controller
{
    public function index()
    {
        // cache with pagination
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $posts = cache()->remember('index-posts-' . $currentPage, 86400, function () {
            return Post::published()
                ->select(['id', 'contents', 'description', 'slug'])
                ->with('tagged')
                ->withCount('comments')
                ->orderBy('created_at', 'desc')
                ->paginate(5)
                ->onEachSide(1);
        });

        return view('frontend.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // relocated to ResourceController
    }

    public function fetchByTag(Tag $tag)
    {
        $slug = $tag->slug;
        $posts = Post::withAnyTag([$slug])
            ->published()
            ->select(['id', 'contents', 'description', 'slug'])
            ->withCount('comments')
            ->with('tagged')
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->onEachSide(1);

        return view('frontend.posts.index', compact('posts', 'tag'));
    }
}
