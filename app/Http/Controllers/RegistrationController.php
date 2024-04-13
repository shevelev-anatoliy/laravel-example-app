<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registration\StoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->only(['first_name', 'email', 'password']);

        $user = User::query()->create($data);

        Auth::login($user);

        return redirect()->route('login');
    }
}
