<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TemplateRequest;
use App\Models\Template;
use App\Services\AssetsHandler;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::orderBy('created_at', 'desc')
            ->paginate(5)
            ->onEachSide(1);
        return view('backend.templates.index', compact('templates'));
    }

    public function create(Template $template)
    {
        return view('backend.templates.create', compact('template'));
    }

    public function store(TemplateRequest $request)
    {
        $template = new Template();
        $template->create([
            'name'        => $request->name,
            'description' => $request->description,
            'file_name'   => Str::snake($request->file_name),
            'file'        => AssetsHandler::createFile($request->file, $request->file_name),
            'css'         => AssetsHandler::createCss($request->css, $request->file_name, 'templates'),
            'js'          => AssetsHandler::createJs($request->js, $request->file_name, 'templates'),
        ]);

        return redirect()->route('templates');
    }

    public function edit(Template $template)
    {
        // show files contents
        $template->file = Storage::disk('template_views')->get("$template->file.blade.php");
        $template->css = Storage::disk('public')->get("/css/templates/$template->css");
        $template->js = Storage::disk('public')->get("/js/templates/$template->js");

        return view('backend.templates.edit', compact('template'));
    }

    public function update(TemplateRequest $request, Template $template)
    {
        // protect demo files in case in file_name rename
        if ($template->file_name != $request->file_name and $template->file_name !== 'demo') {
            Storage::disk('template_views')->delete("$template->file.blade.php");
            Storage::disk('public')->delete("/css/templates/$template->css");
            Storage::disk('public')->delete("/js/templates/$template->js");
        }

        $template->update([
            'name'        => $request->name,
            'description' => $request->description,
            'file_name'   => Str::snake($request->file_name),
            'file'        => AssetsHandler::createFile($request->file, $request->file_name),
            'css'         => AssetsHandler::createCss($request->css, $request->file_name, 'templates'),
            'js'          => AssetsHandler::createJs($request->js, $request->file_name, 'templates'),
        ]);

        return redirect()->route('templates');
    }

    public function destroy(Template $template)
    {
        // protect demo files
        if ($template->file_name !== 'demo') {
            Storage::disk('template_views')->delete("$template->file.blade.php");
            Storage::disk('public')->delete("/css/templates/$template->css");
            Storage::disk('public')->delete("/js/templates/$template->js");
        }

        $template->delete();
        return back();
    }
}
