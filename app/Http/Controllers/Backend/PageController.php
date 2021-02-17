<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;
use App\Models\Page;
use App\Services\MetadataHandler;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('created_at', 'desc')
            ->paginate(5)
            ->onEachSide(1);
        return view('backend.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('backend.pages.create');
    }

    public function store(ResourceRequest $request)
    {
        $page = new Page();
        $page->create([
            'contents'    => $request->contents,
            'title'       => $request->title,
            'description' => $request->description,
            'slug'        => MetadataHandler::generateSlug($request->slug),
            'template'    => MetadataHandler::generateTemplate($request->template),
            'css'         => $this->cssHandler(
                $request->css,
                MetadataHandler::generateSlug($request->slug)),
        ]);

        return redirect()->route('pages');
    }

    public function edit(Page $page)
    {
        if ($page->css) {
            $page->css = Storage::disk('public')->get('/css/pages/' . $page->css);
        }

        return view('backend.pages.edit', compact('page'));
    }

    public function update(ResourceRequest $request, Page $page)
    {
        $page->update([
            'contents'    => $request->contents,
            'title'       => $request->title,
            'description' => $request->description,
            'slug'        => MetadataHandler::generateSlug($request->slug),
            'template'    => MetadataHandler::generateTemplate($request->template),
            'css'         => $this->cssHandler(
                $request->css,
                MetadataHandler::generateSlug($request->slug)),
        ]);

        return redirect()->route('pages');
    }

    public function cssHandler($css, $slug)
    {
        if ($css) {
            Storage::disk('public')->put('/css/pages/' . $slug . '.css', $css);
            return $slug . '.css';
        }
            return null;
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->back();
    }
}
