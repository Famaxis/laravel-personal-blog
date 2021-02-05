<?php

namespace App\Inspections;

class Antispam
{
    protected $keywords = [
        'http',
        'www',
        '%',
        '$',
        '.com',
        '.info'
    ];

    public function detect($body, $name)
    {
        foreach ($this->keywords as $keyword) {
            if (stripos($body, $keyword) !== false || stripos($name, $keyword) !== false) {
                return true;
            }
        }
    }
}