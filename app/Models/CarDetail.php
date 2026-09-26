<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarDetail extends Model
{
    public const POWERS = ['diesel', 'petrol', 'hybrid', 'electric', 'gas'];

    protected $fillable = [
        'car_id',
        'power',
        'door_count',
        'has_navigation',
        'has_bluetooth',
        'has_panorama',
        'has_usp',
        'has_background_camera',
        'has_sensors',
        'has_apple_play',
    ];

    protected function casts(): array
    {
        return [
            'door_count' => 'integer',
            'has_navigation' => 'boolean',
            'has_bluetooth' => 'boolean',
            'has_panorama' => 'boolean',
            'has_usp' => 'boolean',
            'has_background_camera' => 'boolean',
            'has_sensors' => 'boolean',
            'has_apple_play' => 'boolean',
        ];
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
