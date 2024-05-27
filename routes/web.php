<?php

use App\Http\Controllers\DinoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $recentDinos = DB::table('dinos')->latest()->take(12)->get();
    return view('welcome', ['dinos' => $recentDinos]);
})->name('login');

// TODO: use {user:discord_id} to identify user
Route::get('/users/{user}/', function ($user) {
    return redirect('/users/' . $user . '/all');
});
Route::get('/users/{user}/{kind}', [UserController::class, 'show']);

Route::get('/dinos/{dino}', [DinoController::class, 'show']);
Route::middleware('auth')->group(function () {
    Route::post('/dinos/{dino}/covet', [DinoController::class, 'covet']);
    Route::post('/dinos/{dino}/shun', [DinoController::class, 'shun']);
    Route::post('/dinos/{dino}/favourite', [DinoController::class, 'favourite']);
});

require __DIR__ . '/auth.php';
