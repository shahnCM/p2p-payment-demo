<?php

namespace App\Traits;

use App\DataTransferObjects\NewUserWithWalletDto;
use App\Exceptions\InvalidClassProperty;

trait DtoGenerics
{
    private function setProperties(array $properties): void
    {
        foreach ($properties as $propertyName => $propertyValue) {
            $this->$propertyName = $propertyValue;
        }
    }

    public function preciseDto(array $arr): object
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
