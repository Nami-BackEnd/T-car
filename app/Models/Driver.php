<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'drivers';

    protected $fillable = [
        'name',
        'assigned_to_all_branches',
        'phone_code',
        'phone',
        'license_expiration_date',
        'identity_number',
        'email',
        'password',
        'lang',
        'is_verified',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
        'assigned_to_all_branches' => 'boolean',
        'license_expiration_date' => 'date',
    ];
}
