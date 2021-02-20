<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    public function run()
    {
        DB::table('pages')->insert([
            'title'            => 'A place without a name',
            'description'      => 'Under a burning sky',
            'contents'         => '<p>There\'s no milk and honey here,</p>
                                   <p>In the land of God</p>',
            'slug'             => 'demo_page',
            'default_template' => 'blue',
            'custom_template'  => 1,
        ]);
    }
}
