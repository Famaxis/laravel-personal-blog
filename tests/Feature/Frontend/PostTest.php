<?php

namespace Tests\Feature\Frontend;

use App\Models\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function testPostsFrontendList()
    {
        $post = Post::create([
            'contents'         => 'Published post',
            'slug'             => 'published_post',
            'is_published'     => 1,
            'default_template' => 'sea',
        ]);

        $post2 = Post::create([
            'contents'         => 'Unpublished post',
            'slug'             => 'unpublished_post',
            'is_published'     => null,
            'default_template' => 'sea',
        ]);

        $this->get(route('front.posts'))
            ->assertOk()
            ->assertSee('Published post')
            ->assertDontSee('Unpublished post');

        $post->delete();
        $post2->delete();
    }

    public function testPostFrontendShow()
    {
        $post = Post::create([
            'contents'         => 'Published post',
            'slug'             => 'published_post',
            'is_published'     => 1,
        ]);

        $this->get(route('front.resource.show', $post->slug))
            ->assertOk()
            ->assertSee('Published post');

        $post->delete();
    }
}
