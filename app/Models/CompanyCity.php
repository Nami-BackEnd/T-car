<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyCity extends Model
{
    protected $fillable = [
        'company_profile_id',
        'city_id',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_profile_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}