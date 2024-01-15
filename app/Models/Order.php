<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['status_name'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assigned_to()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function getStatusNameAttribute()
    {
        return OrderStatus::getValue($this->status) ;
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, OrderItem::class, 'order_id', 'id');
    }
}
