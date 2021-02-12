<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;
use App\Models\Page;
use App\Services\MetadataHandler;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    private $metadataHandler;

    public function __construct(MetadataHandler $metadataHandler)
    {
        $this->metadataHandler = $metadataHandler;
    }

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

    public function store()
    {
        $page = new Page();
        $page->create([
            'content'     => request('content'),
            'title'       => request('title'),
            'description' => request('description'),
            'slug'        => $this->metadataHandler->generateSlug(request('slug')),
            'template'    => $this->metadataHandler->generateTemplate(request('template')),
            'css'         => $this->cssHandler(
                request('css'),
                $this->metadataHandler->generateSlug(request('slug'))),
        ]);

        return redirect()->route('pages');
    }

    public function edit(Page $page)
    {
        if ($page->css) {
            $page->css = Storage::disk('public')->get('/css/pages/'. $page->css);
        }

        return view('backend.pages.edit', compact('page'));
    }

    public function update(ResourceRequest $request, Page $page)
    {
//        $page = $request->validated();

        $page->update([
            'content'     => request('content'),
            'title'       => request('title'),
            'description' => request('description'),
            'slug'        => $this->metadataHandler->generateSlug(request('slug')),
            'template'    => $this->metadataHandler->generateTemplate(request('template')),
            'css'         => $this->cssHandler(
                request('css'),
                $this->metadataHandler->generateSlug(request('slug'))),
        ]);


        return redirect()->route('pages');
    }

    public function cssHandler ($css, $slug)
    {
        if ($css) {
            Storage::disk('public')->put('/css/pages/'. $slug .'.css', $css);
            return $slug . '.css';
        } else {
            return null;
        }
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->back();
    }
}
