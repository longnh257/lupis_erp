<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Helper\Helpers;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = [
        'revenue',
        'revenue_format',
        'sell_price_format',
        'cost_format',
        'revenue_format',
    ];
    
    protected $with = ['product'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function getRevenueAttribute()
    {
        return $this->sell_price * $this->sell_quantity;
    }
    public function getCostFormatAttribute()
    {
        return Helpers::currency_format($this->cost);
    }
    public function getSellPriceFormatAttribute()
    {
        return Helpers::currency_format($this->sell_price);
    }
    public function getRevenueFormatAttribute()
    {
        return Helpers::currency_format($this->revenue);
    }
}
