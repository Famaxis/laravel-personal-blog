<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'comment' => $this->faker->paragraph,
            'post_id' => 1,
        ];
    }
}
