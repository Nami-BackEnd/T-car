<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarService extends Model
{
    protected $fillable = [
        'car_id',
        'car_additional_service_id',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function additionalService(): BelongsTo
    {
        return $this->belongsTo(CarAdditionalService::class, 'car_additional_service_id');
    }
}
