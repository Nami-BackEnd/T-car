<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = [
        'title_ar',
        'title_en',
        'latitude',
        'longitude',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
        ];
    }

    public function airports(): HasMany
    {
        return $this->hasMany(Airport::class);
    }

    public function trainStations(): HasMany
    {
        return $this->hasMany(TrainStation::class);
    }
}
