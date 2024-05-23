<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dino>
 */
class DinoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => User::factory(),
            'name' => fake()->unique()->name(),
            'filename' => fake()->filePath(),
            'discord_url' => fake()->imageUrl(),
            'worth' => fake()->numberBetween(1, 10),
            'hotness' => fake()->numberBetween(-10, 10),
            'body' => fake()->word(),
            'mouth' => fake()->word(),
            'eyes' => fake()->word(),
        ];
    }
}
