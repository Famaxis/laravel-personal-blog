<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = Cache::remember('sitemap-posts', 86400, function () {
            return Post::where('is_published', 1)
                ->orderBy('created_at', 'desc')
                ->get();
        });

        return response()
            ->view('system.sitemap', compact('posts'))
            ->header('Content-Type', 'text/xml');
    }
}
