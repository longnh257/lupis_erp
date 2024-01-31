<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['status_name', 'is_editable'];

    public function getIsEditableAttribute()
    {
        $user = User::find(Auth::id());
        if (!in_array($this->status, ['COMPLETED', 'completed', 'cancel', 'CANCEL'])) {
            return true;
        }

        return false;
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

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
