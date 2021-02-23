<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Services\ResourceFilesHandler;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        $post = Post::create([
            'first_sentence'   => 'It was a nice day',
            'description'      => 'About my day',
            'contents'         => '<p>Today I wrote the code. Yesterday, too, as well as a month ago. Hm-m, what should I do tomorrow?</p>',
            'slug'             => 'my_day',
            'is_published'     => 1,
            'default_template' => 'sand',
            'css'              => ResourceFilesHandler::createCss(
                'header, footer {background: radial-gradient(circle, var(--darker-optional) 0%, var(--optional-color) 100%);}',
                'my_day',
                'resources'),
        ]);
        $post->tag('today, yesterday, day, night, exciting news');

        $post2 = Post::create([
            'first_sentence'   => 'Let\'s create an app!',
            'contents'         => '<h1>Let\'s create an app!</h1>
                                   <p>Or just download it.</p>',
            'slug'             => 'dealing_with_applications',
            'is_published'     => 1,
            'default_template' => 'sea',
        ]);
        $post2->tag('application, time optimization');

        $post3 = Post::create([
            'first_sentence'   => 'Secret post',
            'contents'         => '<p>This post is unpublished. It\'s only available via a direct link.</p>',
            'slug'             => 'unpublished',
            'is_published'     => null,
            'default_template' => 'blue',
        ]);
        $post3->tag('unpublished');
    }
}
