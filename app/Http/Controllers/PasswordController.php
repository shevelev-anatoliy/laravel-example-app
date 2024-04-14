<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function store(Request $request)
    {
        // ...

        return to_route('password.confirm');
    }

    public function update(Request $request, string $code)
    {
        // ...

        return to_route('login');
    }
}
