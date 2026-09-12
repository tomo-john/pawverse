<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('top'); })->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

});

require __DIR__.'/settings.php';
