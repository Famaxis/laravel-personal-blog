<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = cache()->remember('sitemap-posts', 86400, function () {
            return Post::published()
                ->select(['slug', 'updated_at'])
                ->orderBy('created_at', 'desc')
                ->get();
        });

        return response()
            ->view('system.sitemap', compact('posts'))
            ->header('Content-Type', 'text/xml');
    }
}
