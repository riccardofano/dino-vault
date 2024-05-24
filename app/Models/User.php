<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'discord_id',
        'email',
        'name',
        'nickname',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function dinos(): HasMany
    {
        return $this->hasMany(Dino::class, 'owner_id', 'discord_id');
    }

    public function dinoTransactions(): HasMany
    {
        return $this->hasMany(DinoTransaction::class, 'user_id', 'discord_id');
    }

    public function giftedDinoTransactions(): HasMany
    {
        return $this->hasMany(DinoTransaction::class, 'gifter_id', 'discord_id');
    }

    public function favouritedDinos(): BelongsToMany
    {
        return $this->belongsToMany(Dino::class, table: 'dino_transaction', parentKey: 'discord_id')
            ->wherePivot('type', 'FAVOURITE');
    }

    public function favouriteOwnedDinos()
    {
        return DB::table('dinos')
            ->join('dino_transaction', function ($join) {
                $join
                    ->on('dinos.id', '=', 'dino_id')
                    ->on('type', '=', 'FAVOURITE');
            })
            ->where('owner_id', '=', $this->discord_id);
    }

    // NOTE: named for consistency,
    // it doesn't make much list all the dinos a user has not favourited
    public function trashOwnedDinos()
    {
        return DB::table('dinos')
            ->leftJoin('dino_transaction', function ($join) {
                $join
                    ->on('dinos.id', '=', 'dino_id')
                    ->on('type', '=', 'FAVOURITE');
            })
            ->where('owner_id', '=', $this->discord_id)
            ->whereNull('dino_id');
    }

    public function shunnedDinos(): BelongsToMany
    {
        return $this->belongsToMany(Dino::class, table: 'dino_transaction', parentKey: 'discord_id')
            ->wherePivot('type', 'SHUN');
    }

    public function covetedDinos(): BelongsToMany
    {
        return $this->belongsToMany(Dino::class, table: 'dino_transaction', parentKey: 'discord_id')
            ->wherePivot('type', 'COVET');
    }

    public function receivedDinos(): BelongsToMany
    {
        return $this->belongsToMany(Dino::class, table: 'dino_transaction', parentKey: 'discord_id')
            ->wherePivot('type', 'GIFT')
            ->using(DinoTransaction::class)
            ->withPivot('gifter_id');
    }

    public function giftedDinos(): BelongsToMany
    {
        return $this->belongsToMany(Dino::class, table: 'dino_transaction', parentKey: 'discord_id', foreignPivotKey: 'gifter_id')
            ->wherePivot('type', 'GIFT')
            ->using(DinoTransaction::class)
            ->withPivot('user_id');
    }
}
