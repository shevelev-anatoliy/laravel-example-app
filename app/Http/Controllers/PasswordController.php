<?php

namespace App\Http\Controllers;

use App\Enums\Passwords\PasswordStatusEnum;
use App\Http\Requests\Password\StoreRequest;
use App\Http\Requests\Password\UpdateRequest;
use App\Models\Password;
use App\Models\User;
use App\Notifications\Password\ConfirmPasswordNotification;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function store(StoreRequest $request)
    {
        $ip = $request->ip();

        $email = $request->input('email');

        $user = User::query()
            ->where(compact('email'))
            ->first();

        $password = Password::query()
            ->create(compact('ip', 'email') + ['user_id' => $user?->id]);

        $user?->notify(new ConfirmPasswordNotification($password));

        return to_route('password.confirm');
    }

    public function edit(Password $password)
    {
        abort_unless($password->user_id, 404);
        abort_unless($password->status->is(PasswordStatusEnum::pending), 404);

        return view('password.edit', compact('password'));
    }

    public function update(UpdateRequest $request, Password $password)
    {
        abort_unless($password->user_id, 404);
        abort_unless($password->status->is(PasswordStatusEnum::pending), 404);

        /** @var User */
        $user = $password->user;

        $user->updatePassword($request->input('password'));

        $password->updateStatus(PasswordStatusEnum::completed);

        Auth::login($user);

        return to_route('user');
    }
}
