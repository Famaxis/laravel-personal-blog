<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;
use App\Models\Post;
use App\Services\MetadataHandler;
use Conner\Tagging\Model\Tag;

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

    public function create()
    {
        $tags = Post::existingTags()->pluck('name');
        return view('backend.posts.create', compact('tags'));
    }

    public function store(ResourceRequest $request)
    {
        $post = Post::create([
            'contents'       => $request->contents,
            'is_published'   => $request->is_published,
            'description'    => $request->description,
            'slug'           => MetadataHandler::generateSlug($request->slug),
            'first_sentence' => MetadataHandler::generateFirstSentence($request->contents, $request->description),
            'template'       => MetadataHandler::generateTemplate($request->template),
        ]);
        $post->tag(explode(',', $request->tags));

        return redirect()->route('posts');
    }

    public function edit(Post $post)
    {
        $tags = Post::existingTags()->pluck('name');

        return view('backend.posts.edit', compact('post', 'tags'));
    }

    public function update(ResourceRequest $request, Post $post)
    {
        $post->update([
            'contents'       => $request->contents,
            'is_published'   => $request->is_published,
            'description'    => $request->description,
            'slug'           => MetadataHandler::generateSlug($request->slug),
            'first_sentence' => MetadataHandler::generateFirstSentence($request->contents, $request->description),
            'template'       => MetadataHandler::generateTemplate($request->template),
        ]);
        $post->retag($request->tags);

        return redirect()->route('posts');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
}
