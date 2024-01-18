<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const IN_PROGRESS = 'Đang Xử Lý';
    const COMPLETED = 'Hoàn Thành';
    const PENDING = 'Đợi Duyệt';
    const CANCEL = 'Đã Hủy';

    const in_progress = 'Đang Xử Lý';
    const completed = 'Hoàn Thành';
    const pending = 'Đợi Duyệt';
    const cancel = 'Đã Hủy';
}
