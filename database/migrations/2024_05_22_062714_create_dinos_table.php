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

            $table->index('owner_id', 'owner_idx');
            $table->unique(['body', 'mouth', 'eyes']);
        });

        Schema::create('dino_transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'discord_id');
            $table->foreignId('dino_id')->constrained('dinos');
            $table->foreignId('gifter_id')->nullable()->constrained('users', 'discord_id');
            $table->enum('type', ['GIFT', 'COVET', 'SHUN', 'FAVOURITE']);
            $table->timestamps();

            $table->index('user_id', 'user_idx');
            $table->index('dino_id', 'dino_idx');
            $table->index('type', 'type_idx');
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
