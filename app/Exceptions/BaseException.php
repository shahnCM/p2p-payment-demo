<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;

class BaseException extends \Exception
{
    use ApiResponser;
}
