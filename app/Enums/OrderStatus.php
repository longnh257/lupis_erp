<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const INPROGRESS = 'in_progress';
    const COMPLETED = 'completed';
    const CANCEL = 'cancel';
  
}
