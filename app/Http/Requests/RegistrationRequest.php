<?php

namespace App\Http\Requests;

class RegistrationRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'currency' => 'required|string|in:USD,BDT,EU'
        ];
    }
}
