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

    // user can choose template, or it will be picked randomly
    public function generatePostTemplate($template)
    {
        if ($template) {
            return $template;
        }
        return "template 4";
    }

    // user can choose slug, or it will be generated from timestamp
    public function generatePostSlug($slug)
    {
        if ($slug) {
            return $slug;
        }
        return Carbon::now()->format('Y-m-d-His');
    }

    // for using first sentence in meta: page title or/and in description
    public function generateFirstSentence($content, $description)
    {
        $sentence = $this->prepareFirstSentence($content, $description);

        // if string is too long for type STRING in db
        if($sentence) {
            if (strlen($sentence) > 255) {
                $result = mb_strimwidth($sentence, 0, 255, "...");
                return $result;
            } else {
                return $sentence;
            }
        } else {
            return null;
        }
    }

    public function prepareFirstSentence ($content, $description)
    {
        // title from H1, if it exists
        if (strpos($content, 'h1') !== false) {
            $pattern = "#<\s*?h1\b[^>]*>(.*?)</h1\b[^>]*>#s";
            preg_match($pattern, $content, $matches);
            return $matches[1];
        }

        // preparing content
        $content = html_entity_decode(strip_tags($content));

        // removing some possible misprints
        $content = str_replace(" .", ".", $content);
        $content = str_replace(" ?", "?", $content);
        $content = str_replace(" !", "!", $content);

        // first sentence from the content
        if (preg_match('/^.*[^\s](\.|\?|\!)/U', $content, $match)) {
            return $match[0];
        } else if ($description) {
            // first sentence from the description
            if (preg_match('/^.*[^\s](\.|\?|\!)/U', $description, $match)) {
                return $match[0];
            }
        } else {
            // if method can't generate first sentence neither from content or description
            return null;
        }
    }
}
