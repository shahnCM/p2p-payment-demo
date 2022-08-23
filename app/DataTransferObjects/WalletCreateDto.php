<?php

namespace App\DataTransferObjects;

use App\Exceptions\InvalidClassProperty;
use App\Traits\DtoGenerics;

class WalletCreateDto extends BaseDto
{
    use DtoGenerics;

    private int $userId;
    private string $currency;
    private string $amount;

    private static WalletCreateDto $instance;

    private final function __construct() {}

    public static function instantiate(): self
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
