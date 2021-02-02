<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Conner\Tagging\Model\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    private $post;

    public function __construct()
    {
        $this->post = new Post;
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')
            ->with('tagged')
            ->paginate(5)
            ->onEachSide(1);
        return view('backend.posts.index', compact('posts'));
    }

    public function fetchByTag(Tag $tag)
    {
        $slug = $tag->slug;
        $posts = Post::withAnyTag([$slug])
            ->orderBy('created_at', 'desc')
            ->with('tagged')
            ->paginate(5);

        return view('backend.posts.index')
            ->with(compact('posts'))
            ->with(compact('tag'));
    }

    public function create()
    {
        $tags = Post::existingTags()->pluck('name');
        return view('backend.posts.create', compact('tags'));
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'content'        => request('content'),
            'description'    => request('description'),
            'is_published'   => request('is_published'),
            'slug'           => $this->post->generatePostSlug(request('slug')),
            'first_sentence' => $this->post->generateFirstSentence(request('content'), request('description')),
            'template'       => $this->post->generatePostTemplate(request('template')),
        ]);
        $post->tag(explode(',', $request->tags));

        return redirect()->route('posts');
    }

    public function edit(Post $post)
    {
        $tags = Post::existingTags()->pluck('name');

        return view('backend.posts.edit')
            ->with(compact('post'))
            ->with(compact('tags'));
    }

    public function update(StorePostRequest $request, Post $post)
    {
        $post->update([
            'content'        => request('content'),
            'description'    => request('description'),
            'is_published'   => request('is_published'),
            'slug'           => $this->post->generatePostSlug(request('slug')),
            'first_sentence' => $this->post->generateFirstSentence(request('content'), request('description')),
            'template'       => $this->post->generatePostTemplate(request('template')),
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
