<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::livewire('/', 'pages::landing')->name('home');

Route::livewire('/product/1', 'pages::product.item')->name('product.item');

// require __DIR__.'/settings.php';
