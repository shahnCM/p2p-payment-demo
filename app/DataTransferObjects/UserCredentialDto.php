<?php

namespace App\DataTransferObjects;

use App\Exceptions\InvalidClassProperty;
use App\Traits\DtoGenerics;

class UserCredentialDto extends BaseDto
{
    use DtoGenerics;

    private string $email;
    private string $password;

    private static UserCredentialDto $instance;

    private final function __construct() {}

    public static function instantiate(): self
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
