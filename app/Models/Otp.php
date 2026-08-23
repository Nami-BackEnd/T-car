<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = [
        'type',
        'otp',
        'expire_at',
        'is_used',
        'phone',
        'phone_code',
        'otp_type',
    ];

    protected $casts = [
        'expire_at' => 'datetime',
        'is_used'   => 'boolean',
    ];
}
