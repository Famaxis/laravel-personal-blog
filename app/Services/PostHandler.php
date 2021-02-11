<?php

namespace App\Services;

use Carbon\Carbon;

class PostHandler
{
    // user can choose template, or it will be picked randomly
    public function generateTemplate($template)
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
    public function generateSlug($slug)
    {
        if ($slug) {
            // replacing whitespaces
            $slug = str_replace(" ", "_", $slug);
            return $slug;
        }
        return Carbon::now()->format('Y-m-d-His');
    }

    // for using first sentence in meta: page title or/and in description
    public function generateFirstSentence($content, $description)
    {
        // let's see, what we can extract from content and description...
        $sentence = $this->prepareFirstSentence($content, $description);

        // if extracted string is too long for type STRING in db, make it shorter
        if($sentence) {
            if (strlen($sentence) > 255) {
                return mb_strimwidth($sentence, 0, 255, "...");
            } else {
                return $sentence;
            }
            // if there is nothing that we can extract, let it be null
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