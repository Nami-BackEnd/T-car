<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'phone_code',
        'email',
        'birth_date',
        'latitude',
        'longitude',
        'lang',
        'city_id',
        'address_name',
        'balance',
        'current_step'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date'        => 'date',
        'latitude'          => 'decimal:8',
        'longitude'         => 'decimal:8',
        'balance'           => 'decimal:2',
        'password'          => 'hashed',
    ];

    public function licenses(): hasOne
    {
        return $this->hasOne(UserLicense::class);
    }
}
