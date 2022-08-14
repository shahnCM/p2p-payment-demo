<?php

namespace App\Http\Requests;

class LoginRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }
}
