<?php

namespace App\Http\Controllers;

use App\Http\Requests\Password\StoreRequest;
use App\Models\User;
use App\Notifications\Password\ConfirmNotification;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function store(StoreRequest $request)
    {
        $email = $request->input('email');

        $user = User::query()
            ->where(compact('email'))
            ->first();

        $user?->notify(new ConfirmNotification);

        return to_route('password.confirm');
    }

    public function update(Request $request, string $code)
    {
        // ...

        return to_route('login');
    }
}
