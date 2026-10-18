<?php

namespace Database\Factories;

use App\Models\Snippet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Snippet>
 */
class SnippetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'body' => "set number\nset relativenumber\nnnoremap <leader>w :w<CR>",
            'description' => fake()->paragraph(),
            'user_id' => User::factory(),
        ];
    }
}
