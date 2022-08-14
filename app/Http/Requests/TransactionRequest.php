<?php

namespace App\Http\Requests;

class TransactionRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'amount_in_sender_currency' => 'required|numeric',
            'receiver_id' => 'required|numeric',
            'receiver_wallet_id' => 'required|numeric',
            'receiver_currency' => 'required|in:USD,EU,BDT',
        ];
    }

    public function messages(): array
    {
        return [
            'amount_in_sender_currency.required' => 'amount_in_sender_currency is required',
            'amount_in_sender_currency.numeric' => 'amount_in_sender_currency has to be numeric',
            'receiver_id.required' => 'receiver_id is required',
            'receiver_id.numeric' => 'receiver_id has to be numeric',
            'receiver_wallet_id.required' => 'receiver_id is required',
            'receiver_wallet_id.numeric' => 'receiver_wallet_id has to be numeric',
            'receiver_currency.required' => 'receiver_currency is required',
            'receiver_currency.in' => 'receiver_currency is invalid, only USD, EU, BDT are supported now',
        ];
    }
}
