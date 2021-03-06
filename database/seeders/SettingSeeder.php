<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->insert([
            'site_name'        => 'My blog',
            'main_template'    => 'blue',
            'comments_allowed' => true,
            'confirm_deletion' => false,
        ]);
    }
}
