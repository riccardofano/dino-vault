<?php

namespace Database\Seeders;

use App\Models\Dino;
use App\Models\DinoTransaction;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory()->count(20)->create();

        $users->each(function ($user) {
            Dino::factory()->count(100)->create(['owner_id' => $user->discord_id]);
        });

        DinoTransaction::factory()->count(1000)->create();
    }
}
