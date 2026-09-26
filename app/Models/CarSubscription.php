<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarSubscription extends Model
{
    protected $fillable = [
        'car_id',
        'month_count',
        'price',
        'lowest_price',
    ];

    protected function casts(): array
    {
        return [
            'month_count' => 'integer',
            'price' => 'decimal:2',
            'lowest_price' => 'decimal:2',
        ];
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
