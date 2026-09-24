<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BranchDeliveryOnlyPrice extends Model
{
    protected $fillable = [
        'branch_id',
        'distance',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'distance' => 'decimal:2',
            'price' => 'decimal:2',
        ];
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
