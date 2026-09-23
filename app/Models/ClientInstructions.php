<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientInstructions extends Model
{
    protected $fillable = [
        'content_ar',
        'content_en',
    ];

    protected $appends = ['content'];

    public function getContentAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->content_ar : $this->content_en;
    }
}
