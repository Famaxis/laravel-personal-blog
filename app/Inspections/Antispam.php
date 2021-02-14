<?php

namespace App\Inspections;

class Antispam
{
    protected static $keywords = [
        'http',
        'www',
        '%',
        '$',
        '.com',
        '.info'
    ];

    public static function detect($body, $name)
    {
        foreach (static::$keywords as $keyword) {
            if (stripos($body, $keyword) !== false || stripos($name, $keyword) !== false) {
                return true;
            }
        }
    }
}