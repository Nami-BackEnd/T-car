<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BranchWorkingHour extends Model
{
    protected $fillable = [
        'branch_id',
        'day',
        'is_open',
        'from',
        'to',
    ];

    protected function casts(): array
    {
        return [
            'is_open' => 'boolean',
            'from' => 'datetime:H:i',
            'to' => 'datetime:H:i',
        ];
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
