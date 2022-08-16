<?php

namespace App\DataTransferObjects;

use App\Exceptions\InvalidClassProperty;

class TransactionDto extends BaseDto
{
    public static function instance(): self
    {
        return new self();
    }

    public function get(string $propertyName)
    {
        if(! property_exists($this, $propertyName)) {
            throw new InvalidClassProperty();
        }
        return $this->$propertyName;
    }
}
