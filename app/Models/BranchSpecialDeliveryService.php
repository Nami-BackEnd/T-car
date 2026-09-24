<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BranchSpecialDeliveryService extends Model
{
    protected $fillable = [
        'branch_id',
        'price',
        'distance',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'distance' => 'decimal:2',
        ];
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
