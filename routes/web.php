<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dog\Index;
use App\Livewire\Dog\Show;
use App\Livewire\PublicDog\Index as PublicDogIndex;

Route::get('/', function () {
    return view('pages.top');
})->name('home');

// ログイン必須のエリアをグループ化
Route::middleware(['auth', 'verified'])->group(function () {

    // ダッシュボード
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // My Dogs
    Route::get('dogs', Index::class)->name('dog.index');
    Route::get('dogs/{dog}', Show::class)->name('dog.show');

});

// 公開犬(ログイン不要)
Route::get('public/dogs', PublicDogIndex::class)->name('public.dog.index');

// Sandbox
Route::get('sandbox', function () {
    return view('sandbox.index');
})->name('sandbox.index');

require __DIR__.'/settings.php';
