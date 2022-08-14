<?php

namespace App\Contracts;

use stdClass;

interface DataTransferObjectBuilder
{
    function dirtyDto(array $arr): object;
    function preciseDto(array $arr): object;
}
