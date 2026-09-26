<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarBranch extends Model
{
    protected $fillable = [
        'car_id',
        'branch_id',
        'stock',
    ];

    protected function casts(): array
    {
        return [
            'stock' => 'integer',
        ];
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
