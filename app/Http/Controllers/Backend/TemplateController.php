<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'file'        => $request->file,
            'css'         => $request->css,
            'js'          => $request->js,
        ]);

        return redirect()->route('templates');
    }

    public function edit(Template $template)
    {
        if ($template->css) {
            $template->css = Storage::disk('public')->get('/css/templates/' . $template->css);
        }

        return view('backend.templates.edit', compact('template'));
    }

    public function update(Request $request, Template $template)
    {
        $template->update([
            'name'        => $request->name,
            'description' => $request->description,
            'file'        => $request->file,
            'css'         => $request->css,
            'js'          => $request->js,
        ]);

        return redirect()->route('templates');
    }

    public function destroy(Template $template)
    {
        $template->delete();
        return redirect()->back();
    }
}
