<?php

namespace App\Services;

use Illuminate\Support\Str;

class MetadataHandler
{
    // user can choose template, or it will be picked randomly
    public static function generateTemplate($template)
    {
        if ($template) {
            return $template;
        }

        $random_num = mt_rand(1, 3);
        switch ($random_num) {
            case 1:
                return "blue";
            case 2:
                return "red";
            case 3:
                return "purple";
        }
    }

    // user can choose slug, or it will be generated from timestamp
    public static function generateSlug($slug)
    {
        if ($slug) {
            // replacing whitespaces
             return Str::snake($slug);
        }
        return now()->format('Y-m-d-His');
    }

    // for using first sentence in meta: page title or/and in description
    public static function generateFirstSentence($contents, $description)
    {
        // let's see, what we can extract from content and description...
        $sentence = static::prepareFirstSentence($contents, $description);

        // if extracted string is too long for type STRING in db, make it shorter
        if($sentence) {
            if (strlen($sentence) > 255) {
                return mb_strimwidth($sentence, 0, 255, "...");
            }
                return $sentence;
        }
        // if there is nothing that we can extract, set the default value
        return 'Post';
    }

    public static function prepareFirstSentence ($contents, $description)
    {
        // title from H1, if it exists
        if (strpos($contents, 'h1') !== false) {
            $pattern = "#<\s*?h1\b[^>]*>(.*?)</h1\b[^>]*>#s";
            preg_match($pattern, $contents, $matches);
            return $matches[1];
        }

        // preparing content
        $contents = strip_tags($contents);

        // removing some possible misprints
        $contents = str_replace([" .", " ?", " !"], [".", "?", "!"], $contents);

        // first sentence from the content
        if (preg_match('/^.*[^\s](\.|\?|\!)/U', $contents, $match)) {
            return $match[0];
        } else if ($description) {
            // first sentence from the description
            if (preg_match('/^.*[^\s](\.|\?|\!)/U', $description, $match)) {
                return $match[0];
            }
        }
        // if method can't generate first sentence neither from content or description
        return implode(' ', array_slice(explode(' ', $contents), 0, 5));

    }
    
    public static function checkIfPostHasImage($contents)
    {
        if(strpos($contents, '<img')){
            return true;
        }
            return false;
    }
}