<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BranchTrainStation extends Model
{
    protected $fillable = [
        'branch_id',
        'train_station_id',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function trainStation(): BelongsTo
    {
        return $this->belongsTo(TrainStation::class);
    }
}
