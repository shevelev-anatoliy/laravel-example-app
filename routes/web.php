<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\User\Settings\PasswordController as UserPasswordController;
use App\Http\Controllers\User\Settings\ProfileController;
use App\Http\Controllers\User\SettingsController;
use App\Http\Middleware\EmailConfirmedMiddleware;
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

    Route::view('/password', 'password.index')->name('password');
    Route::post('/password', [PasswordController::class, 'store'])->name('password.store');
    Route::view('/password/confirm', 'password.confirm')->name('password.confirm');
    Route::get('/password/{password:uuid}', [PasswordController::class, 'edit'])->name('password.edit')->whereUuid('password');
    Route::post('/password/{password:uuid}', [PasswordController::class, 'update'])->name('password.update')->whereUuid('password');
});

Route::get('email/confirmation', [EmailController::class, 'index'])->name('email.confirmation')->middleware('auth');
Route::any('email/{email:uuid}/confirm', [EmailController::class, 'confirm'])->name('email.confirm')->whereUuid('email');
Route::post('email/{email:uuid}/send', [EmailController::class, 'send'])->name('email.send')->whereUuid('email');

Route::post('logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'online'])->group(function () {
    Route::redirect('/user', '/user/settings')->name('user');
    Route::get('/user/settings', [SettingsController::class, 'index'])->name('user.settings');
    Route::get('/user/settings/profile', [ProfileController::class, 'edit'])->name('user.settings.profile.edit')->middleware(EmailConfirmedMiddleware::class);
    Route::post('/user/settings/profile', [ProfileController::class, 'update'])->name('user.settings.profile.update')->middleware(EmailConfirmedMiddleware::class);
    Route::get('/user/settings/password', [UserPasswordController::class, 'edit'])->name('user.settings.password.edit');
    Route::post('/user/settings/password', [UserPasswordController::class, 'update'])->name('user.settings.password.update');

    Route::controller(ChatController::class)->group(function () {
        Route::get('/chat', 'index')->name('chat');
        Route::get('/messages', 'messages');
        Route::post('/send', 'send');
    });
});
