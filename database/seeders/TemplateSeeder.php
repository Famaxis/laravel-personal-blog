<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    public function run()
    {
        DB::table('templates')->insert([
            'name'        => 'Demo',
            'description' => 'Demo template. You can apply it to a page or a post with some content',
            'file_name'   => 'demo',
            'file'        => 'demo',
            'css'         => 'demo.css',
            'js'          => 'demo.js',
        ]);
    }
}
