<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Dino extends Model
{
    use HasFactory;

    static $fragments = [];
    static $bodyFragments = [];
    static $mouthFragments = [];
    static $eyesFragments = [];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'discord_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(DinoTransaction::class);
    }

    public function coveters(): HasMany
    {
        return $this->hasMany(DinoTransaction::class)->where('type', '=', 'COVET');
    }

    public function shunners(): HasMany
    {
        return $this->hasMany(DinoTransaction::class)->where('type', '=', 'SHUN');
    }
}
