<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alrt extends Model
{
    protected $fillable = [
        'title_ar',
        'title_en',
    ];

    protected $appends = ['title'];

    public function getTitleAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->title_ar : $this->title_en;
    }
}
