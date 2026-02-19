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
                Route::livewire('/review', 'pages.account.reviews')->name('review');
                Route::livewire('/order/{id}', 'pages.account.order-detail')->name('order.detail');
                Route::livewire('/order/{id}/review', 'pages.account.order-review')->name('order.review');
                Route::livewire('/settings', 'pages.account.setting')->name('settings');
                Route::livewire('/favorite', 'pages.account.favorite')->name('favorite');
                Route::livewire('/addresses', 'pages.account.addresses')->name('addresses');
            });

        // checkout
        Route::livewire('/checkout', 'pages.handler.checkout')->name('checkout.index');

        Route::prefix('dashboard')
            ->name('')
            ->middleware(['auth', 'verified', 'is_admin'])
            ->group(function () {
                Route::view('/', 'dashboard.index')->name('dashboard');

                // kategori produk
                Route::view('/category', 'dashboard.category.index')->name('category.index');
                Route::view('/category/create', 'dashboard.category.create')->name('category.create');
                Route::view('/category/edit/{id}', 'dashboard.category.edit')->name('category.edit');

                // produk
                Route::view('/product', 'dashboard.product.index')->name('product.index');
                Route::view('/product/create', 'dashboard.product.create')->name('product.create');
                Route::view('/product/edit/{id}', 'dashboard.product.edit')->name('product.edit');

                // pelanggan
                Route::view('/customer', 'dashboard.customer.index')->name('customer.index');
                Route::view('/customer/view/{id}', 'dashboard.customer.view')->name('customer.view');

                // transaksi
                Route::view('/transaction', 'dashboard.transaction.index')->name('transaction.index');
                Route::view('/transaction/view/{id}', 'dashboard.transaction.view')->name('transaction.view');

                // pengiriman
                Route::view('/delivery', 'dashboard.delivery.index')->name('delivery.index');
                Route::view('/delivery/view/{id}', 'dashboard.delivery.view')->name('delivery.view');
            });
    });

require __DIR__.'/settings.php';
