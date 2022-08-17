<?php

namespace App\DataTransferObjects;

use App\Exceptions\InvalidClassProperty;
use App\Traits\DtoGenerics;

class TransactionDto extends BaseDto
{
    use DtoGenerics;

    private static TransactionDto $instance;

    public static function instantiate(): self
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
