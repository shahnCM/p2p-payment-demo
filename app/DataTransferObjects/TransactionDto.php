<?php

namespace App\DataTransferObjects;

class TransactionDto extends BaseDto
{
    public static function instance(): self
    {
        return new self();
    }
}
