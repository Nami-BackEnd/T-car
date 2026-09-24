<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BranchDriverService extends Model
{
    protected $fillable = [
        'branch_id',
        'day_price',
        'week_price',
        'month_price',
    ];

    protected function casts(): array
    {
        return [
            'day_price' => 'decimal:2',
            'week_price' => 'decimal:2',
            'month_price' => 'decimal:2',
        ];
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
