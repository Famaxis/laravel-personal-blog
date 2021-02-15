<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function show(Page $page)
    {
        return view('frontend.pages.single', compact('page'));
    }
}
