<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserRole extends Enum
{
    const superadmin = 1;
    const manager = 2;
    const store_employee = 3;
    const full_time_driver = 4;
    const part_time_driver = 5;
}
