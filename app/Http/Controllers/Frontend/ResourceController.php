<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;

class ResourceController extends Controller
{
    // is requested slug relevant to post or page?
    public function show($request)
    {
        if (Post::where('slug', $request)->first()) {
            $resource = Post::where('slug', $request)
                ->with('comments.user')
                ->with('tagged')
                ->first();
            return $this->showPost($resource);
        }

        if (Page::where('slug', $request)->first()) {
            $resource = Page::where('slug', $request)->first();
            return $this->showPage($resource);
        }

        // if there is no resource with this slug
        return abort('404');
    }

    public function showPost($resource)
    {
        $next = Post::select(['slug'])
            ->where('id', '>', $resource->id)
            ->published()
            ->oldest('id')
            ->first();
        $prev = Post::select(['slug'])
            ->where('id', '<', $resource->id)
            ->published()
            ->latest('id')
            ->first();

        // view for custom template
        if ($resource->custom_template) {
            return view('frontend.posts.single-custom', compact('resource', 'next', 'prev'));
        }
        // view for default template
        return view('frontend.posts.single', compact('resource', 'next', 'prev'));
    }

    public function showPage($resource)
    {
        // view for custom template
        if ($resource->custom_template) {
            // for common templates
            $next = null;
            $prev = null;
            return view('frontend.pages.single-custom', compact('resource', 'next', 'prev'));
        }
        // view for default template
        return view('frontend.pages.single', compact('resource'));
    }
}
