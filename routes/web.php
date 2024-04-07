<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home.index')->name('home');

Route::get('/contacts', static function () {
    return view('contacts.index');
})->name('contacts');

Route::controller(ChatController::class)->group(function () {
    Route::get('/chat', 'index')->name('chat');
});
