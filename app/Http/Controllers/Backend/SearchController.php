<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Page;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";

            // search in posts
            $posts = Post::where('contents', 'LIKE', '%' . $request->search . "%")
                ->orWhere('description', 'LIKE', '%' . $request->search . "%")
                ->get();

            // search in pages
            $pages = Page::where('contents', 'LIKE', '%' . $request->search . "%")
                ->orWhere('description', 'LIKE', '%' . $request->search . "%")
                ->get();

            if ($posts) {
                foreach ($posts as $post) {
                    $output .=
                        '<a href="' . route('posts.edit', $post->slug) . '">
                                <div class="search-item padding-small">' . $post->first_sentence . '</div>
                            </a>';
                }
            }

            if ($pages) {
                foreach ($pages as $page) {
                    $output .=
                        '<a href="' . route('pages.edit', $page->slug) . '">
                                <div class="search-item padding-small">' . $page->title . '</div>
                            </a>';
                }
            }
            return Response($output);
        }
        return null;
    }
}
