<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;
use App\Models\Page;
use App\Models\Template;
use App\Services\MetadataHandler;
use App\Services\ResourceFilesHandler;
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

    public function create(Page $page)
    {
        $templates = Template::all();

        return view('backend.pages.create', compact('templates', 'page'));
    }

    public function store(ResourceRequest $request)
    {
        $page = new Page();
        $page->create([
            'contents'         => $request->contents,
            'title'            => $request->title,
            'description'      => $request->description,
            'custom_template'  => $request->custom_template,
            'slug'             => MetadataHandler::generateSlug($request->slug),
            'default_template' => MetadataHandler::generateTemplate($request->default_template),
            'css'              => ResourceFilesHandler::createCss($request->css, MetadataHandler::generateSlug($request->slug), 'resources'),
            'js'               => ResourceFilesHandler::createJs($request->js, MetadataHandler::generateSlug($request->slug), 'resources')
        ]);

        return redirect()->route('pages');
    }

    public function edit(Page $page)
    {
        if ($page->css) {
            $page->css = Storage::disk('public')->get("/css/resources/$page->css");
        }
        if ($page->js) {
            $page->js = Storage::disk('public')->get("/js/resources/$page->js");
        }
        $templates = Template::all();

        return view('backend.pages.edit', compact('page', 'templates'));
    }

    public function update(ResourceRequest $request, Page $page)
    {
        $page->update([
            'contents'         => $request->contents,
            'title'            => $request->title,
            'description'      => $request->description,
            'custom_template'  => $request->custom_template,
            'slug'             => MetadataHandler::generateSlug($request->slug),
            'default_template' => MetadataHandler::generateTemplate($request->default_template),
            'css'              => ResourceFilesHandler::createCss($request->css, MetadataHandler::generateSlug($request->slug), 'resources'),
            'js'               => ResourceFilesHandler::createJs($request->js, MetadataHandler::generateSlug($request->slug), 'resources')
        ]);

        return redirect()->route('pages');
    }

    public function destroy(Page $page)
    {
        Storage::disk('public')->delete("/css/resources/$page->css");
        Storage::disk('public')->delete("/js/resources/$page->js");
        $page->delete();
        return redirect()->back();
    }
}
