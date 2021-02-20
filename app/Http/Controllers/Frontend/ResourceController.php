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
            $resource = Post::where('slug', $request)->first();
            return $this->showPost($resource);
        }

        if (Page::where('slug', $request)->first()){
            $resource = Page::where('slug', $request)->first();
            return $this->showPage($resource);
        }

        return abort('404');
    }

    public function showPost($resource)
    {
        // optimizing queries number
        if($resource->tagNames())  {
            $tags = Post::existingTags()->pluck('name');
        } else {
            $tags = [];
        }

        $next = Post::where('id', '>', $resource->id)
            ->published()
            ->oldest('id')
            ->first();
        $prev = Post::where('id', '<', $resource->id)
            ->published()
            ->latest('id')
            ->first();

        // view for custom template
        if($resource->custom_template) {
            return view('frontend.posts.single-custom', compact('resource','next', 'prev', 'tags'));
        }
        // view for default template
        return view('frontend.posts.single', compact('resource','next', 'prev', 'tags'));
    }

    public function showPage($resource)
    {
        // view for custom template
        if($resource->custom_template)
        {
            return view('frontend.pages.single-custom', compact('resource'));
        }
        // view for default template
        return view('frontend.pages.single', compact('resource'));
    }
}
