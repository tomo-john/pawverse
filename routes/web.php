<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/mypage', [HomeController::class, 'mypage'])
    ->middleware('auth')
    ->name('mypage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/dogs/public', [DogController::class, 'public'])->name('dogs.public');
Route::patch('dogs/{dog}/toggle-public', [DogController::class, 'togglePublic'])->name('dogs.toggle-public');
Route::middleware('auth')->group(function () {
    Route::resource('dogs', DogController::class);
});

Route::get('/sandbox', function () {
    return view('sandbox');
})->middleware('auth')->name('sandbox');
