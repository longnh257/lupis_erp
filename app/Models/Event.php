<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        if ($this->event_type == 'work') {
            if ($this->shift == 1) {
                return "Làm Ca 1";
            }
            if ($this->shift == 2) {
                return "Làm Ca 2";
            }
            if ($this->shift == 3) {
                return "Làm Ca 3";
            }
        } else {
            return "Nghỉ phép";
        }
    }
}
