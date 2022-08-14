<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class TransactionStatus extends Enum {
    const I = 'INITIATED';
    const S = 'SUCCESSFUL';
    const F = 'FAILED';
}
