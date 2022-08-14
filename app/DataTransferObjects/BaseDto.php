<?php

namespace App\DataTransferObjects;

use App\Exceptions\InvalidClassProperty;
use App\Exceptions\MethodNotDefined;
use App\Contracts\DataTransferObjectBuilder;

abstract class BaseDto implements DataTransferObjectBuilder
{
    public function __set($name, $value)
    {
        throw new InvalidClassProperty();
    }

    public function dirtyDto(array $arr): object
    {
        return json_decode(json_encode($arr));
    }

    public function preciseDto(array $arr): object
    {
        throw new MethodNotDefined();
    }
}
