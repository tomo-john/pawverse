<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dog;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// ログイン必須のエリアをグループ化
Route::middleware(['auth', 'verified'])->group(function () {

    // ダッシュボード
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Dog Componet
    Route::get('dog', Dog::class)->name('dog.index');

});

// Sandbox
Route::get('/sandbox', function () {
    return view('sandbox.index');
})->name('sandbox.index');

require __DIR__.'/settings.php';
