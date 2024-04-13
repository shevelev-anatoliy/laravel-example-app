<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email:filter', 'max:100'],
            'password' => ['required', 'string', Password::defaults()],
            'remember' => ['nullable', 'boolean'],
        ];
    }
}
