<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::livewire('/', 'pages.home')->name('home');

Route::livewire('/today-promo', 'pages.today-promos')->name('today-promo');

Route::livewire('/best-seller', 'pages.best-seller')->name('best-seller');

Route::prefix('product')
    ->name('product.')
    ->group(function () {
        Route::livewire('/product/{id}', 'pages.product.detail')->name('detail');
    });

Route::middleware('auth')
    ->name('')
    ->group(function () {
        // untuk file
        Route::get('/file/{path}', function ($path) {
            abort_unless(
                Storage::disk('local')->exists($path),
                404
            );

            return Storage::disk('local')->response($path);
        })
            ->where('path', '.*')
            ->name('file.stream');

        // akun customer
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

        // checkout
        Route::prefix('checkout')
            ->name('checkout.')
            ->group(function () {
                Route::livewire('/', 'pages.handler.checkout')->name('index');
            });

        Route::prefix('dashboard')
            ->name('')
            ->middleware(['auth', 'verified'])
            ->group(function () {
                Route::view('/', 'dashboard.index')->name('dashboard');

                // kategori produk
                Route::view('/category', 'dashboard.category.index')->name('category.index');
                Route::view('/category/create', 'dashboard.category.create')->name('category.create');
                Route::view('/category/edit/{id}', 'dashboard.category.edit')->name('category.edit');
            });
    });

require __DIR__.'/settings.php';
