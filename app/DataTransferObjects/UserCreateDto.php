<?php

namespace App\DataTransferObjects;

use App\Exceptions\InvalidClassProperty;
use JetBrains\PhpStorm\NoReturn;
use stdClass;

class UserCreateDto extends BaseDto
{
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

    private function setProperties(array $properties): void
    {
        foreach ($properties as $propertyName => $propertyValue) {
            $this->$propertyName = $propertyValue;
        }
    }

    public function preciseDto(array $arr): UserCreateDto
    {
        $dto = new self();
        $dto->setProperties($arr);

        return $dto;
    }

    public function get($property)
    {
        return $this->$property;
    }
}
