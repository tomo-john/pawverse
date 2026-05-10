<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dog\Index;
use App\Livewire\Dog\Show;
use App\Livewire\PublicDog\Index as PublicDogIndex;
use App\Livewire\Dashboard\World;

Route::get('/', function () {
    return view('pages.top');
})->name('home');

// ログイン必須のエリアをグループ化
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('dashboard', World::class)->name('dashboard');

    // Dogs
    Route::get('dogs', Index::class)->name('dog.index');
    Route::get('dogs/create', Create::class)->name('dog.create');
    Route::get('dogs/{dog}', Show::class)->name('dog.show');

});

// Public Dog
Route::get('public/dogs', PublicDogIndex::class)->name('public.dog.index');

// Sandbox
Route::get('sandbox/{page}', function ($page) {
    abort_if(!View::exists("sandbox.{$page}"), 404);
    return view("sandbox.{$page}");
})->name('sandbox.page');

require __DIR__.'/settings.php';
