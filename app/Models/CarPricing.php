<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarPricing extends Model
{
    protected $table = 'car_pricing';

    protected $fillable = [
        'car_id',
        'day_price',
        'day_lowest_price',
        'week_price',
        'week_lowest_price',
        'month_price',
        'month_lowest_price',
        'free_km',
        'free_km_price',
    ];

    protected function casts(): array
    {
        return [
            'day_price' => 'decimal:2',
            'day_lowest_price' => 'decimal:2',
            'week_price' => 'decimal:2',
            'week_lowest_price' => 'decimal:2',
            'month_price' => 'decimal:2',
            'month_lowest_price' => 'decimal:2',
            'free_km' => 'integer',
            'free_km_price' => 'decimal:2',
        ];
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
