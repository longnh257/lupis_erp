<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['title', 'status_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function getStatusNameAttribute()
    {
        $name = '';

        switch ($this->status) {
            case (0):
                $name = 'Đợi duyệt';
                break;
            case (1):
                $name = 'Đã duyệt';
                break;
            case (2):
                $name = 'Đã từ chối';
                break;
            default:
        }

        return $name;
    }

    public function getTitleAttribute()
    {
        $isManager = User::checkUserRole();
        if ($this->event_type == 'work') {
            if ($isManager) {
                if ($this->shift == 1) {
                    return "Ca 1 - " . $this->user->name . " - " . $this->status_name;
                }
                if ($this->shift == 2) {
                    return "Ca 2 - " . $this->user->name . " - " . $this->status_name;
                }
                if ($this->shift == 3) {
                    return "Ca 3 - " . $this->user->name . " - " . $this->status_name;
                }
            } else {
                if ($this->shift == 1) {
                    return "Ca 1" . " - " . $this->status_name;
                }
                if ($this->shift == 2) {
                    return "Ca 2" . " - " . $this->status_name;
                }
                if ($this->shift == 3) {
                    return "Ca 3" . " - " . $this->status_name;
                }
            }
        } else {
            if ($isManager) {
                return $this->user->name . " - Nghỉ phép" . " - " . $this->status_name;
            } else {
                return "Nghỉ phép" . " - " . $this->status_name;
            }
        }
    }
}
