<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('auth');

Route::get('/users/{user}', function (User $user) {
    $dinos = $user->dinos()->paginate(24);
    return view('user', ['user' => $user, 'dinos' => $dinos]);
});

require __DIR__ . '/auth.php';
