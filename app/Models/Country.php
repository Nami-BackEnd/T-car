<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedTitle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasLocalizedTitle;

    protected $fillable = [
        'title_ar',
        'title_en',
        'phone_code',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'country_id');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'country_id');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('title_ar');
    }
}
