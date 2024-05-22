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
        return [
            'user_id' => User::factory()->create()->discord_id,
            'dino_id' => Dino::factory(),
            'gifter_id' => null,
            'type' => ''
        ];
    }
}
