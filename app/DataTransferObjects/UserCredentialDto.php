<?php

namespace App\DataTransferObjects;

use App\Exceptions\InvalidClassProperty;

class UserCredentialDto extends BaseDto
{
    private string $email;
    private string $password;

    private static UserCredentialDto $instance;

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

    public function preciseDto(array $arr): self
    {
        $dto = new self();
        $dto->setProperties($arr);

        return $dto;
    }

    public function get(string $propertyName)
    {
        if(! property_exists($this, $propertyName)) {
            throw new InvalidClassProperty();
        }
        return $this->$propertyName;
    }
}
