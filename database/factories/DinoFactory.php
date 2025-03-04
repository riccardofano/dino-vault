<?php

namespace Database\Factories;

use App\Models\Dino;
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
        // Generate a unique set of body/mouth/eyes
        do {
            $body = fake()->randomElement(Dino::$bodyFragments);
            $mouth = fake()->randomElement(Dino::$mouthFragments);
            $eyes = fake()->randomElement(Dino::$eyesFragments);

            $exists = Dino::where('body', $body)
                ->where('mouth', $mouth)
                ->where('eyes', $eyes)
                ->exists();
        } while ($exists);

        return [
            'owner_id' => User::factory(),
            'name' => fake()->unique()->name(),
            'filename' => fake()->filePath(),
            'discord_url' => fake()->imageUrl(width: 112, height: 112),
            'worth' => fake()->numberBetween(1, 10),
            'hotness' => fake()->numberBetween(-10, 10),
            'body' => $body,
            'mouth' => $mouth,
            'eyes' => $eyes,
        ];
    }
}
