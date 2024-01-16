<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['thumbnail_url'];


    public function getThumbnailUrlAttribute()
    {
        return Storage::url($this->getStoragePath());
    }

    // Helper method to get the storage path
    protected function getStoragePath()
    {
        return "public/uploads/{$this->thumbnail}";
    }


    public function logs(): HasMany
    {
        return $this->hasMany(ProductLog::class);
    }

}
