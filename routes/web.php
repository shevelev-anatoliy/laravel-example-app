<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\User\Settings\ProfileController;
use App\Http\Controllers\User\SettingsController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home.index')->name('home');

Route::get('/contacts', static function () {
    return view('contacts.index');
})->name('contacts');

Route::middleware('guest')->group(function () {
    Route::view('/registration', 'registration.index')->name('registration');
    Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');

    Route::view('/login', 'login.index')->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::post('logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'online'])->group(function () {
    Route::redirect('/user', '/user/settings')->name('user');
    Route::get('/user/settings', [SettingsController::class, 'index'])->name('user.settings');
    Route::get('/user/settings/profile', [ProfileController::class, 'edit'])->name('user.settings.profile.edit');
    Route::post('/user/settings/profile', [ProfileController::class, 'update'])->name('user.settings.profile.update');

    Route::controller(ChatController::class)->group(function () {
        Route::get('/chat', 'index')->name('chat');
        Route::get('/messages', 'messages');
        Route::post('/send', 'send');
    });
});
