<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLicense extends Model
{
    protected $table = 'user_licenses';

    protected $fillable = [
        'user_id',
        'license',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function getLicenseAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
