<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home.index')->name('home');

Route::get('/contacts', static function () {
    return view('contacts.index');
})->name('contacts');

Route::controller(ChatController::class)->group(function () {
    Route::get('/chat', 'index')->name('chat');
    Route::get('/messages', 'messages');
    Route::post('/send', 'send');
});

Route::view('/registration', 'registration.index')->name('registration');
Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');

Route::view('/login', 'login.index')->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
