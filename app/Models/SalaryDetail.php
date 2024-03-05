<?php

namespace App\Models;

use App\Helper\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [
        'total_salary_format',
        'revenue_format',
        'salary_format',
        'status_name'
    ];


    const STATUS = [
        0 => 'Đang Xử Lý',
        1 => 'Hoàn Thành',
        2 => 'Đã Hủy',
    ];

    public static function getStatus($i)
    {
        if (in_array($i, [0, 1, 2]))
            return self::STATUS[$i];

        return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getRevenueFormatAttribute()
    {
        return Helpers::currency_format($this->revenue);
    }

    public function getSalaryFormatAttribute()
    {
        return Helpers::currency_format($this->salary);
    }

    public function getTotalSalaryFormatAttribute()
    {
        return Helpers::currency_format($this->total_salary);
    }

    public function getStatusNameAttribute()
    {
        return $this->getStatus($this->status);
    }
}
