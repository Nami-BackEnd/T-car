<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
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
}
