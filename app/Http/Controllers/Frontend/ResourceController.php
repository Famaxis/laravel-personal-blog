<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;

class ResourceController extends Controller
{
    public function show($request)
    {
        if (Post::where('slug', $request)->first()){
            $post = Post::where('slug', $request)->first();
            return $this->showPost($post);
        }

        if (Page::where('slug', $request)->first()){
            $page = Page::where('slug', $request)->first();
            return $this->showPage($page);
        }

        return abort('404');
    }

    public function showPost($post)
    {
        // optimizing queries number
        if($post->tagNames())  {
            $tags = Post::existingTags()->pluck('name');
        } else {
            $tags = [];
        }

        $next = Post::where('id', '>', $post->id)
            ->published()
            ->oldest('id')
            ->first();
        $prev = Post::where('id', '<', $post->id)
            ->published()
            ->latest('id')
            ->first();

        return view('frontend.posts.single', compact('post','next', 'prev', 'tags'));
    }

    public function showPage($page)
    {
        return view('frontend.pages.single', compact('page'));
    }
}
