<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\StoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->only(['email', 'password']);

        $remember = (bool) $request->input('remember');

        // простой способ
        if (! Auth::attempt($data, $remember)) {
            return back()->withErrors([
                'email' => 'Неверный логин или пароль.',
            ])->onlyInput('email');
        }

        // ручной способ
        // $user = User::query()
        //     ->where('email', $data['email'])
        //     ->first();

        // if (! $user) {
        //     return back()->withErrors([
        //         'email' => 'Неверный логин или пароль.',
        //     ])->onlyInput('email');
        // }

        // if (! Hash::check($data['password'], $user->password)) {
        //     return back()->withErrors([
        //         'email' => 'Неверный логин или пароль.',
        //     ])->onlyInput('email');
        // }

        // Auth::login($user, $remember);

        $request->session()->regenerate();

        return redirect()->intended('/user');
    }
}
