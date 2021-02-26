<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;
use App\Models\Post;
use App\Models\Template;
use App\Services\MetadataHandler;
use App\Services\ResourceFilesHandler;
use Conner\Tagging\Model\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('tagged')
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->onEachSide(1);
        return view('backend.posts.index', compact('posts'));
    }

    public function fetchByTag(Tag $tag)
    {
        $slug = $tag->slug;
        $posts = Post::withAnyTag([$slug])
            ->with('tagged')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('backend.posts.index', compact('posts', 'tag'));
    }

    public function create(Post $post)
    {
        $templates = Template::all();
        $tags = Post::existingTags()->pluck('name');
        return view('backend.posts.create', compact('tags', 'templates', 'post'));
    }

    public function store(ResourceRequest $request)
    {
        $post = Post::create([
            'contents'         => $request->contents,
            'is_published'     => $request->is_published,
            'description'      => $request->description,
            'custom_template'  => $request->custom_template,
            'slug'             => MetadataHandler::generateSlug($request->slug),
            'has_image'        => MetadataHandler::checkIfPostHasImage($request->contents),
            'first_sentence'   => MetadataHandler::generateFirstSentence($request->contents, $request->description),
            'default_template' => MetadataHandler::generateTemplate($request->default_template),
            'css'              => ResourceFilesHandler::createCss($request->css,
                MetadataHandler::generateSlug($request->slug), 'resources'),
            'js'               => ResourceFilesHandler::createJs($request->js,
                MetadataHandler::generateSlug($request->slug), 'resources')
        ]);
        $post->tag(explode(',', $request->tags));

        return redirect()->route('posts');
    }

    public function edit(Post $post)
    {
        if ($post->css) {
            $post->css = Storage::disk('public')->get("/css/resources/$post->css");
        }
        if ($post->js) {
            $post->js = Storage::disk('public')->get("/js/resources/$post->js");
        }
        $templates = Template::all();
        $tags = Post::existingTags()->pluck('name');

        return view('backend.posts.edit', compact('post', 'tags', 'templates'));
    }

    public function update(ResourceRequest $request, Post $post)
    {
        if ($post->slug != $request->slug) {
            Storage::disk('public')->delete("/css/resources/$post->css");
            Storage::disk('public')->delete("/js/resources/$post->js");
        }

        $post->update([
            'contents'         => $request->contents,
            'is_published'     => $request->is_published,
            'description'      => $request->description,
            'custom_template'  => $request->custom_template,
            'slug'             => MetadataHandler::generateSlug($request->slug),
            'has_image'        => MetadataHandler::checkIfPostHasImage($request->contents),
            'first_sentence'   => MetadataHandler::generateFirstSentence($request->contents, $request->description),
            'default_template' => MetadataHandler::generateTemplate($request->default_template),
            'css'              => ResourceFilesHandler::createCss($request->css,
                MetadataHandler::generateSlug($request->slug), 'resources'),
            'js'               => ResourceFilesHandler::createJs($request->js,
                MetadataHandler::generateSlug($request->slug), 'resources')
        ]);
        $post->retag($request->tags);

        return redirect()->route('posts');
    }

    public function destroy(Post $post)
    {
        Storage::disk('public')->delete("/css/resources/$post->css");
        Storage::disk('public')->delete("/js/resources/$post->js");
        $post->delete();
        return redirect()->back();
    }
}
