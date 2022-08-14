<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class TransactionType extends Enum{
    const T = 'TRANSFER';
    const C = 'CONVERSION';
}
