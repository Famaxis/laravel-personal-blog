<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $posts = Post::published()
                ->where('contents', 'LIKE', '%' . $request->search . "%")
                ->orWhere('description', 'LIKE', '%' . $request->search . "%")
                ->get();
            if ($posts) {
                foreach ($posts as $post) {
                    $output .=
                        '<a href="' . route('front.resource.show',$post->slug) . '">
                                <div class="search-item padding-small">' . $post->first_sentence . '</div>
                            </a>';
                }
                return Response($output);
            }
            return null;
        }
        return null;
    }
}
