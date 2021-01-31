<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class InsertionTest extends TestCase
{
    public function testPostCanBeAdded()
    {
        $user = User::first();

        $this->withoutExceptionHandling();
        $response = $this->actingAs($user)
            ->post('/home', [
            'content' => 'Here is content.',
            'is_published' => true,
            'description' => 'Description',
            'tags' => 'tag, second tag, third tag'
        ]);
        $response->assertStatus(302);
//        $this->assertTrue(count(Post::all()) > 1);
    }
}
