<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            TemplateSeeder::class,
            PageSeeder::class,
            PostSeeder::class
        ]);

        Comment::factory()->count(10)->create();
    }
}
