<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::livewire('/', 'pages::landing')->name('home');

Route::livewire('/product/1', 'pages::product.item')->name('product.item');

Route::prefix('account')
    ->name('account.')
    ->group(function () {
        Route::livewire('/me', 'pages::account.my')->name('my');
    });

// require __DIR__.'/settings.php';
