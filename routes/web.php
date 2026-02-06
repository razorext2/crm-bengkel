<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::livewire('/', 'pages::landing')->name('home');
Route::livewire('/log-in', 'pages::landing.login')->name('customer.login');

Route::livewire('/product/{id}', 'pages::product.item')->name('product.item');

Route::prefix('account')
    ->middleware('auth')
    ->name('account.')
    ->group(function () {
        Route::livewire('/me', 'pages::account.me')->name('me');
        Route::livewire('/order', 'pages::account.order')->name('order');
        Route::livewire('/settings', 'pages::account.settings')->name('settings');
        Route::livewire('/favorite', 'pages::account.favorite')->name('favorite');
    });

// require __DIR__.'/settings.php';
