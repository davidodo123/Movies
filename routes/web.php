<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;



Route::get('/', function () {
    return redirect()->route('movies.index');
});


Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::resource('movies', MovieController::class);

Route::post('movies/{movie}/reviews', [ReviewController::class, 'store'])
    ->name('movies.reviews.store');

Route::resource('directors', DirectorController::class)->only([
    'index', 'show', 'create', 'store', 'destroy'
]);

// Rutas de invitados (solo accesibles si NO estás logueado)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Ruta de salida (solo si estás logueado)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Ejemplo en routes/web.php
Route::resource('movies', MovieController::class)->middleware('auth')->except(['index', 'show']);