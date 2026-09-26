<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedTitle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasLocalizedTitle;

    protected $fillable = [
        'title_ar',
        'title_en',
        'country_id',
        'latitude',
        'longitude',
    ];

    protected function casts(): array
    {
        return [
            'country_id' => 'integer',
            'latitude' => 'float',
            'longitude' => 'float',
        ];
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function airports(): HasMany
    {
        return $this->hasMany(Airport::class);
    }

    public function trainStations(): HasMany
    {
        return $this->hasMany(TrainStation::class);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('title_ar');
    }
}
