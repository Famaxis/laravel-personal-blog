<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;

class TagController extends Controller
{
    public function index()
    {
        $tags = Post::existingTags();
        return view('backend.tags', compact('tags'));
    }
}
