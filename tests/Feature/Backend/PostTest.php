<?php

namespace Tests\Feature\Backend;

use Tests\TestCase;

class PostTest extends TestCase
{
    public function testPostCanBeAdded()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAsAdmin()
            ->post(route('posts.create'), [
                'contents'     => 'Here is content.',
                'is_published' => true,
                'slug'         => 'a slug',
                'description'  => 'Description',
                'tags'         => 'tag, second tag, third tag'
            ]);
        $response->assertStatus(302);
    }

    public function testPostsList()
    {
        $this->actingAsAdmin()
            ->get(route('posts'))
            ->assertOk()
            ->assertSee('Here is content.')
            ->assertSee('Second Tag');
    }

    public function testPostCanBeUpdated()
    {
        $params = $this->validParams();
        $response = $this->actingAsAdmin()->post("home/posts/a_slug", $params);
        $response->assertRedirect(route('posts'));
    }

    public function testPostCanBeDeleted()
    {
        $this->actingAsAdmin()
            ->delete("/home/posts/destroy/a_new_slug")
            ->assertStatus(302);
    }

    private function validParams($overrides = [])
    {
        return array_merge([
            'contents' => "Here is updated content.",
            'slug'     => "a new slug",
            'tags'     => 'tag, third tag'
        ], $overrides);
    }
}
