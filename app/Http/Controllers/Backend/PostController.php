<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Conner\Tagging\Model\Tag;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')
            ->with('tagged')
            ->paginate(5);
        return view('backend.post.index', compact('posts'));
    }

    public function fetch(Tag $tag)
    {
        $slug = $tag->slug;
        $posts = Post::withAnyTag([$slug])
            ->orderBy('created_at', 'desc')
            ->with('tagged')
            ->paginate(5);

        return view('backend.post.index', compact('posts'));
    }

    public function create()
    {
        $tags = Post::existingTags()->pluck('name');
        return view('backend.post.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $this->handleUploadedImage(
            $request->file('upload'),
            $request->input('CKEditorFuncNum')
        );

        $post = Post::create([
            'content'      => request('content'),
            'is_published' => request('is_published'),
            'slug'         => Carbon::now()->format('Y-m-d-His'),
            'title'        => $this->firstSentence(request('content')),
            'template'     => $this->randomTemplate(request('template')),
        ]);
        $post->tag(explode(',', $request->tags));

        return redirect()->route('posts');
    }

    public function randomTemplate($template)
    {
        if ($template) {
            return $template;
        }
        return 101;
    }

    public function handleUploadedImage($image, $CKEditorFuncNum)
    {
        if ($image !== null) {
            $originName = $image->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $image->move(public_path('images'), $fileName);

//            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    function firstSentence($content)
    {
        //title from H1, if it exists
        if (strpos($content, 'h1') !== false) {
            $pattern = "#<\s*?h1\b[^>]*>(.*?)</h1\b[^>]*>#s";
            preg_match($pattern, $content, $matches);
            return $matches[1];
        }

        //title from first sentence
        $content = html_entity_decode(strip_tags($content));

        $content = str_replace(" .", ".", $content);
        $content = str_replace(" ?", "?", $content);
        $content = str_replace(" !", "!", $content);

        if (preg_match('/^.*[^\s](\.|\?|\!)/U', $content, $match)) {
            return $match[0];
        } else {
            return "Title";
        }
    }

    public function edit(Post $post)
    {
        return view('backend.post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return redirect()->route('posts');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts');
    }
}
