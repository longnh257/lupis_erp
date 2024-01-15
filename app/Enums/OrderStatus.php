<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const IN_PROGRESS = 'IN PROGRESS';
    const COMPLETED = 'PENDING';
    const PENDING = 'COMPLETED';
    const CANCEL = 'CANCEL';
}
