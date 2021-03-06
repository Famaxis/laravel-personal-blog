<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;

class ResourceController extends Controller
{
    // is requested slug relevant to post or page?
    public function show($slug)
    {
        $resource = Post::where('slug', $slug)
            ->with('tagged')
            ->withCount('comments')
            ->first();
        if ($resource) {
            return $this->showPost($resource);
        }

        $resource = Page::where('slug', $slug)
            ->first();
        if ($resource) {
            return $this->showPage($resource);
        }

        // if there is no resource with that slug
        abort('404');
    }

    private function showPost($resource)
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
        $comments = $resource->comments()
            ->with('user')
            ->paginate(50)
            ->onEachSide(1);

        // view for custom template
        if ($resource->custom_template) {
            return view('frontend.posts.single-custom', compact('resource', 'comments', 'next', 'prev'));
        }
        // view for default template
        return view('frontend.posts.single', compact('resource', 'comments', 'next', 'prev'));
    }

    private function showPage($resource)
    {
        // view for custom template
        if ($resource->custom_template) {
            // for common templates
            $next = null;
            $prev = null;
            $comments = null;
            return view('frontend.pages.single-custom', compact('resource', 'comments', 'next', 'prev'));
        }
        // view for default template
        return view('frontend.pages.single', compact('resource'));
    }
}
