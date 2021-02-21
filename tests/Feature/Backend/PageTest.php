<?php

namespace Tests\Feature\Backend;

use Tests\TestCase;

class PageTest extends TestCase
{
    public function testPageCanBeAdded()
    {
//        $this->withoutExceptionHandling();
        $response = $this->actingAsAdmin()
            ->post(route('pages.create'), [
                'title'       => 'A page',
                'contents'    => 'Here is a page content.',
                'slug'        => 'page slug',
                'description' => 'Page description',

            ]);
        $response->assertStatus(302);
    }

    public function testPagesList()
    {
        $this->actingAsAdmin()
            ->get(route('pages'))
            ->assertOk()
            ->assertSee('A page')
            ->assertSee('Page description')
            ->assertSee('Here is a page content.');
    }

    public function testPageCanBeUpdated()
    {
        $params = $this->validParams();
        $response = $this->actingAsAdmin()->post('home/pages/page_slug', $params);
        $response->assertRedirect(route('pages'));
    }

    public function testPageCanBeDeleted()
    {
        $this->actingAsAdmin()
            ->delete("/home/pages/destroy/new_page_slug")
            ->assertStatus(302);
    }

    private function validParams($overrides = [])
    {
        return array_merge([
            'contents' => "Here is updated page content.",
            'slug'     => "new page slug",
        ], $overrides);
    }
}
