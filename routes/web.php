<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Dog\World;
use App\Livewire\Dog\Village;
use App\Livewire\Dog\Create;
use App\Livewire\Dog\House;
use App\Livewire\PublicDog\Index as PublicDogIndex;
use App\Livewire\Dog\KennelManager;

Route::get('/', function () {
    return view('pages.top');
})->name('home');

// ログイン必須のエリアをグループ化
Route::middleware(['auth', 'verified'])->group(function () {

    // 旧Village(Index) 検証用
    Route::get('dogs/kennel-manager', KennelManager::class)->name('dog.kennel-manager');

    // Dogs
    Route::get('dogs/world', World::class)->name('dog.world');
    Route::get('dogs/village', Village::class)->name('dog.village');
    Route::get('dogs/create', Create::class)->name('dog.create');
    Route::get('dogs/{dog}', House::class)->name('dog.house');

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
