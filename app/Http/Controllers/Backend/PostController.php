<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\ImageHandler;
use Conner\Tagging\Model\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $imageHandler;
    private $post;

    public function __construct(ImageHandler $imageHandler)
    {
        $this->imageHandler = $imageHandler;
        $this->post = new Post;
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')
            ->with('tagged')
            ->paginate(5);
        return view('backend.posts.index', compact('posts'));
    }

    public function fetch(Tag $tag)
    {
        $slug = $tag->slug;
        $posts = Post::withAnyTag([$slug])
            ->orderBy('created_at', 'desc')
            ->with('tagged')
            ->paginate(5);

//        return view('backend.posts.index', compact('posts'));
        return view('backend.posts.index')
            ->with(compact('posts'))
            ->with(compact('tag'));
    }

    public function create()
    {
        $tags = Post::existingTags()->pluck('name');
        return view('backend.posts.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $this->imageHandler->handleUploadedImage(
            $request->file('upload'),
            $request->input('CKEditorFuncNum')
        );

        $post = Post::create([
            'content'      => request('content'),
            'is_published' => request('is_published'),
            'slug'         => $this->post->generatePostSlug(request('slug')),
            'title'        => $this->post->createPostTitle(request('content')),
            'template'     => $this->post->generatePostTemplate(request('template')),
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

    public function update(Request $request, Post $post)
    {
        $post->update([
            'content'      => request('content'),
            'is_published' => request('is_published'),
            'slug'         => $this->post->generatePostSlug(request('slug')),
            'title'        => $this->post->createPostTitle(request('content')),
            'template'     => $this->post->generatePostTemplate(request('template')),
        ]);
        $post->retag($request->tags);

        return redirect()->route('posts');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts');
    }
}
