<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'phone',
        'password',
        'address',
        'role_id',
        'CID',
        'birthday',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
        'role_name'
    ];


    public function getRoleNameAttribute()
    {
        return $this->role->nice_name;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }


    public function logs(): HasMany
    {
        return $this->hasMany(UserLog::class);
    }

    public function logActivity($action, $details = null, $user_id = null, $performed_by = null)
    {
        $this->logs()->create([
            'action' => $action,
            'details' => $details,
            'user_id' => $user_id,
            'performed_by' => $performed_by,
        ]);
    }


    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->logActivity('account_update', 'Cập nhật thông tin người dùng', $model->id, Auth::id());
        });
    }
}
