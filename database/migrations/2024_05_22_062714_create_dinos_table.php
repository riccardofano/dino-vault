<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dinos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users', 'discord_id');
            $table->string('name')->unique();
            $table->string('filename')->unique();
            $table->string('discord_url');

            $table->integer('worth')->default(1);
            $table->integer('hotness')->default(0);

            $table->string('body');
            $table->string('mouth');
            $table->string('eyes');
            $table->timestamps();
        });

        Schema::create('dino_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'discord_id');
            $table->foreignId('dino_id')->contrained('dinos');
            $table->foreignId('gifter_id')->nullable()->constrained('users', 'discord_id');
            $table->enum('type', ['GIFT', 'COVET', 'SHUN', 'FAVOURITE']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dinos');
        Schema::dropIfExists('dino_user');
    }
};
