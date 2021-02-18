<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ResourceFilesHandler
{
    public static function createFile($file, $filename)
    {
        Storage::disk('template_views')->put($filename . '.blade.php', $file);
        return $filename;
    }

    public static function createCss($css, $filename, $directory)
    {
        if ($css) {
            Storage::disk('public')->put("/css/$directory/$filename.css", $css);
            return $filename . '.css';
        }
        return null;
    }

    public static function createJs($js, $filename, $directory)
    {
        if ($js) {
            Storage::disk('public')->put("/js/$directory/$filename.js", $js);
            return $filename . '.js';
        }
        return null;
    }
}