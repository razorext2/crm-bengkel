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

Route::middleware('auth')->name('')->group(function () {
    Route::prefix('account')
        ->name('account.')
        ->group(function () {
            // Route::livewire('/me', 'pages::account.me')->name('me');
            Route::livewire('/my', 'pages.account.my')->name('me');
            Route::livewire('/orders', 'pages.account.orders')->name('order');
            Route::livewire('/order/{id}', 'pages.account.order-detail')->name('order.detail');
            Route::livewire('/settings', 'pages.account.setting')->name('settings');
            Route::livewire('/favorite', 'pages.account.favorite')->name('favorite');
            Route::livewire('/addresses', 'pages.account.addresses')->name('addresses');
        });

    // untuk checkout
    Route::prefix('checkout')
        ->name('checkout.')
        ->group(function () {
            Route::livewire('/', 'pages.handler.checkout')->name('index');
        });
});

// require __DIR__.'/settings.php';
