<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserWithThirdHighestTransactionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'email' => $this['email'],
            'ThirdHighestTransactionAmount' => $this['completed_debit_transactions'][0]['amount_before']
        ];
    }
}
