<?php

namespace App\Helper;

class Helpers
{
    public static function currency_format($number, $suffix = 'đ')
    {
        if (!empty($number)) {
            return number_format($number, 0, '.', ',') . " {$suffix}";
        }

        return 0  . " {$suffix}";
    }
}
