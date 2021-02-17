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
            'file_name'   => $request->file_name,
            'file'        => $this->createFile($request->file, $request->file_name),
            'css'         => $this->createCss($request->css, $request->file_name),
            'js'          => $this->createJs($request->js, $request->file_name),
        ]);

        return redirect()->route('templates');
    }

    public function createFile($file, $filename)
    {
        Storage::disk('template_views')->put($filename . '.blade.php', $file);
        return $filename . '.blade.php';
    }

    public function createCss($css, $filename)
    {
        if ($css) {
            Storage::disk('public')->put('/css/templates/' . $filename . '.css', $css);
            return $filename . '.css';
        }
        return null;
    }

    public function createJs($js, $filename)
    {
        if ($js) {
            Storage::disk('public')->put('/js/templates/' . $filename . '.js', $js);
            return $filename . '.js';
        }
        return null;
    }

    public function edit(Template $template)
    {
        $template->file = Storage::disk('template_views')->get($template->file);
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
            'file'        => $this->createFile($request->file, $request->file_name),
            'css'         => $this->createCss($request->css, $request->file_name),
            'js'          => $this->createJs($request->js, $request->file_name),
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
