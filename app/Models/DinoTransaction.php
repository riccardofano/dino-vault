<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DinoTransaction extends Model
{
    use HasFactory;

    // Relationship with User (as the recipient)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'discord_id');
    }

    // Relationship with Dino
    public function dino()
    {
        return $this->belongsTo(Dino::class);
    }

    // Relationship with User (as the gifter)
    public function gifter()
    {
        return $this->belongsTo(User::class, 'gifter_id', 'discord_id');
    }
}
