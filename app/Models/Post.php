<?php

namespace App\Models;

use Carbon\Carbon;
use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use Taggable;

    protected $guarded = [];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function generatePostTemplate($template)
    {
        if ($template) {
            return $template;
        }
        return "template 4";
    }

    public function generatePostSlug($slug)
    {
        if ($slug) {
            return $slug;
        }
        return Carbon::now()->format('Y-m-d-His');
    }

    public function createPostTitle($content)
    {
        //title from H1, if it exists
        if (strpos($content, 'h1') !== false) {
            $pattern = "#<\s*?h1\b[^>]*>(.*?)</h1\b[^>]*>#s";
            preg_match($pattern, $content, $matches);
            return $matches[1];
        }

        $content = html_entity_decode(strip_tags($content));

        $content = str_replace(" .", ".", $content);
        $content = str_replace(" ?", "?", $content);
        $content = str_replace(" !", "!", $content);

        //title from first sentence
        if (preg_match('/^.*[^\s](\.|\?|\!)/U', $content, $match)) {
            return $match[0];
        } else {
            return "Title";
        }
    }
}
