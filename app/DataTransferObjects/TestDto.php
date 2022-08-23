<?php

namespace App\DataTransferObjects;

class TestDto extends BaseDto
{
    private final function __construct() {}

    public static function instance(): self
    {
        return new self();
    }
}
