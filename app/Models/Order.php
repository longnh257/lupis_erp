<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Helper\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = [
        'status_name',
        'is_editable',
        'revenue'
    ];

    public function getIsEditableAttribute()
    {
        $user = User::find(Auth::id());
        if (!$user->checkUserRole() && !in_array($this->status, ['cancel', 'CANCEL'])) {
            return false;
        }

        return true;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assigned_user()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function getStatusNameAttribute()
    {
        return OrderStatus::getValue($this->status);
    }

    public function getRevenueFormatAttribute()
    {
        return Helpers::currency_format($this->revenue);
    }

    public function getRevenueAttribute()
    {
        $revenue = $this->order_items->sum(function ($item) {
            return $item->sell_quantity * $item->sell_price;
        });

        return $revenue;
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
