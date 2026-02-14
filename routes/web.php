<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dog\Index;

Route::get('/', function () {
    return view('pages.top');
})->name('home');

// ログイン必須のエリアをグループ化
Route::middleware(['auth', 'verified'])->group(function () {

    // ダッシュボード
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Dog Componet
    Route::get('dogs', Index::class)->name('dog.index');

});

// Sandbox
Route::get('sandbox', function () {
    return view('sandbox.index');
})->name('sandbox.index');

require __DIR__.'/settings.php';
