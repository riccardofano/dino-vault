<?php

use App\Http\Controllers\DinoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// TODO: use {user:discord_id} to identify user
Route::get('/users/{user}/', function ($user) {
    return redirect('/users/' . $user . '/all');
});
Route::get('/users/{user}/{kind}', [UserController::class, 'show']);

Route::get('/dinos/{dino}', [DinoController::class, 'show']);

require __DIR__ . '/auth.php';
