<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Dog\World;
use App\Livewire\Dog\Index;
use App\Livewire\Dog\Create;
use App\Livewire\Dog\Show;
use App\Livewire\PublicDog\Index as PublicDogIndex;

Route::get('/', function () {
    return view('pages.top');
})->name('home');

// ログイン必須のエリアをグループ化
Route::middleware(['auth', 'verified'])->group(function () {

    // Dogs
    Route::get('dogs/world', World::class)->name('dog.world');
    Route::get('dogs', Index::class)->name('dog.index');
    Route::get('dogs/create', Create::class)->name('dog.create');
    Route::get('dogs/{dog}', Show::class)->name('dog.show');

    // Dashboard(Volt)
    Volt::route('dashboard', 'dashboard')->name('dashboard');

});

// Public Dog
Route::get('public/dogs', PublicDogIndex::class)->name('public.dog.index');

// Sandbox
Route::get('sandbox/{page}', function ($page) {
    abort_if(!View::exists("sandbox.{$page}"), 404);
    return view("sandbox.{$page}");
})->name('sandbox.page');

require __DIR__.'/settings.php';
