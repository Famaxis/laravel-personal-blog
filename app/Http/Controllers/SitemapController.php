<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()
            ->view('system.sitemap', compact('posts'))
            ->header('Content-Type', 'text/xml');
    }
}
