<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/login', function () {
    return Socialite::driver('discord')->redirect();
})->middleware('guest');

Route::get('/auth/callback', function () {
    $discordUser = Socialite::driver('discord')->user();

    $user = User::updateOrCreate(
        [
            'discord_id' => $discordUser->id,
        ],
        [
            'discord_id' => $discordUser->id,
            'email' => $discordUser->email,
            'name' => $discordUser->name,
            'nickname' => $discordUser->nickname,
            'avatar' => $discordUser->avatar,
        ]
    );

    Auth::login($user, true);

    return redirect('/');
});

Route::post('/logout', function () {
    Auth::guard('web')->logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->middleware('auth');
