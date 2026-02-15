<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::livewire('/', 'pages.home')->name('home');

Route::livewire('/today-promo', 'pages.today-promos')->name('today-promo');

Route::livewire('/best-seller', 'pages.best-seller')->name('best-seller');

Route::prefix('product')
    ->name('product.')
    ->group(function () {
        Route::livewire('/product/{id}', 'pages.product.detail')->name('detail');
    });

Route::prefix('account')
    ->middleware('auth')
    ->name('account.')
    ->group(function () {
        // Route::livewire('/me', 'pages::account.me')->name('me');
        Route::livewire('/my', 'pages.account.my')->name('me');
        Route::livewire('/orders', 'pages.account.orders')->name('order');
        Route::livewire('/settings', 'pages.account.setting')->name('settings');
        Route::livewire('/favorite', 'pages.account.favorite')->name('favorite');
    });

// require __DIR__.'/settings.php';
