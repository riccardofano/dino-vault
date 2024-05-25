<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dino extends Model
{
    use HasFactory;

    static $fragments = [];
    static $bodyFragments = [];
    static $mouthFragments = [];
    static $eyesFragments = [];

    // Relationship with User
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'discord_id');
    }

    // Relationship with DinoTransaction
    public function dinoTransactions(): HasMany
    {
        return $this->hasMany(DinoTransaction::class);
    }
}
