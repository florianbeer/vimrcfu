<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Snippet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => fake()->paragraph(),
            'snippet_id' => Snippet::factory(),
            'user_id' => User::factory(),
        ];
    }
}
