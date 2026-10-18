<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'github_id' => (string) fake()->unique()->randomNumber(8),
            'github_url' => 'https://github.com/'.fake()->userName(),
            'avatar_url' => 'https://avatars.githubusercontent.com/u/'.fake()->randomNumber(6).'?v=4',
            'email' => fake()->unique()->safeEmail(),
            'name' => fake()->name(),
            'remember_token' => Str::random(10),
        ];
    }
}
