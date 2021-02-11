<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $posts = Page::orderBy('created_at', 'desc')
            ->paginate(5)
            ->onEachSide(1);
        return view('backend.pages.index', compact('posts'));
    }

    public function create()
    {
        return view('backend.pages.create');
    }

    public function store()
    {
        $page = new Page();
        $page->create([
            'content'        => request('content'),
            'title'        => request('title'),
            'description'    => request('description'),
            'slug'           => $this->postHandler->generateSlug(request('slug')),
            'template'       => $this->postHandler->generateTemplate(request('template')),
        ]);

        return redirect()->route('pages');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->back();
    }
}
