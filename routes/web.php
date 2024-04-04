<?php

use App\Models\Slide;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home.index')->name('home');

Route::get('/contacts', static function () {
    return view('contacts.index');
})->name('contacts');
