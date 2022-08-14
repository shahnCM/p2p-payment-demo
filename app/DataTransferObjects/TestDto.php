<?php

namespace App\DataTransferObjects;

class TestDto extends BaseDto
{
    public static function instance(): self
    {
        return new self();
    }
}
