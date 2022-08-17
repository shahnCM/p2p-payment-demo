<?php

namespace App\DataTransferObjects;

use App\Exceptions\InvalidClassProperty;
use App\Traits\DtoGenerics;
use JetBrains\PhpStorm\NoReturn;
use stdClass;

class UserCreateDto extends BaseDto
{
    use DtoGenerics;

    private string $name;
    private string $email;
    private string $password;
    private string $currency;
    private bool $active = true;

    private static UserCreateDto $instance;

    public static function instantiate(): self
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
