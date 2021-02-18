<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ResourceFilesHandler;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::orderBy('created_at', 'desc')
            ->paginate(5)
            ->onEachSide(1);
        return view('backend.templates.index', compact('templates'));
    }

    public function create()
    {
        return view('backend.templates.create');
    }

    public function store(Request $request)
    {
        $template = new Template();
        $template->create([
            'name'        => $request->name,
            'description' => $request->description,
            'file_name'   => $request->file_name,
            'file'        => ResourceFilesHandler::createFile($request->file, $request->file_name),
            'css'         => ResourceFilesHandler::createCss($request->css, $request->file_name, 'templates'),
            'js'          => ResourceFilesHandler::createJs($request->js, $request->file_name, 'templates'),
        ]);

        return redirect()->route('templates');
    }

    public function edit(Template $template)
    {
        $template->file = Storage::disk('template_views')->get($template->file . '.blade.php');
        $template->css = Storage::disk('public')->get('/css/templates/' . $template->css);
        $template->js = Storage::disk('public')->get('/js/templates/' . $template->js);

        return view('backend.templates.edit', compact('template'));
    }

    public function update(Request $request, Template $template)
    {
        if ($template->file_name != $request->file_name)
        {
            Storage::disk('template_views')->delete($template->file);
            Storage::disk('public')->delete('/css/templates/' . $template->css);
            Storage::disk('public')->delete('/js/templates/' . $template->js);
        }

        $template->update([
            'name'        => $request->name,
            'description' => $request->description,
            'file_name'   => $request->file_name,
            'file'        => ResourceFilesHandler::createFile($request->file, $request->file_name),
            'css'         => ResourceFilesHandler::createCss($request->css, $request->file_name, 'templates'),
            'js'          => ResourceFilesHandler::createJs($request->js, $request->file_name, 'templates'),
        ]);

        return redirect()->route('templates');
    }

    public function destroy(Template $template)
    {
        Storage::disk('template_views')->delete($template->file);
        Storage::disk('public')->delete('/css/templates/' . $template->css);
        Storage::disk('public')->delete('/js/templates/' . $template->js);
        $template->delete();
        return redirect()->back();
    }
}
