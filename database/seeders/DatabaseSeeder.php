<?php

namespace Database\Seeders;

use App\Models\Dino;
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
        $users = User::factory(20)->create();
        $users->each(function ($user) {
            Dino::factory(20)->create(['owner_id' => $user->discord_id]);
        });
    }
}
