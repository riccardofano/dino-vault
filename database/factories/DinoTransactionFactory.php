<?php

namespace Database\Factories;

use App\Models\Dino;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DinoTransaction>
 */
class DinoTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $dino = Dino::inRandomOrder()->first();

        $type = $this->faker->randomElement(['GIFT', 'COVET', 'SHUN', 'FAVOURITE']);
        $gifter = $type === 'GIFT' ? User::inRandomOrder()->first() : null;

        return [
            'user_id' => $user->discord_id,
            'dino_id' => $dino->id,
            'gifter_id' => $gifter?->discord_id,
            'type' => $type
        ];
    }
}
