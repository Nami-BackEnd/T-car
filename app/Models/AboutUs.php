<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $fillable = [
        'type',
        'title_ar',
        'title_en',
        'content_ar',
        'content_en',
    ];

    protected $casts = [
        'type' => 'string',
    ];

    protected $appends = ['title', 'content'];

    public function getTitleAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->title_ar : $this->title_en;
    }

    public function getContentAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->content_ar : $this->content_en;
    }
}
