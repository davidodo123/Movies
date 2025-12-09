<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\ProfileController;


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
