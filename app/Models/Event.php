<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['title'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTitleAttribute()
    {
        $isManager = User::checkUserRole();
        if ($this->event_type == 'work') {
            if ($isManager) {
                if ($this->shift == 1) {
                    return $this->user->name . " --- Ca 1";
                }
                if ($this->shift == 2) {
                    return $this->user->name . " --- Ca 2";
                }
                if ($this->shift == 3) {
                    return $this->user->name . " --- Ca 3";
                }
            } else {
                if ($this->shift == 1) {
                    return "Ca 1";
                }
                if ($this->shift == 2) {
                    return "Ca 2";
                }
                if ($this->shift == 3) {
                    return "Ca 3";
                }
            }
        } else {
            if ($isManager) {
                return $this->user->name . " --- Nghỉ phép";
            } else {
                return "Nghỉ phép";
            }
        }
    }
}
