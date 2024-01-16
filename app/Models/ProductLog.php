<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['created_at_format'];

    public function getCreatedAtFormatAttribute()
    {
        return  $this->created_at->format('H:i:s - d-m-Y');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
