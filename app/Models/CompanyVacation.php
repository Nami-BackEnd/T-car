<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyVacation extends Model
{
    protected $fillable = [
        'company_id',
        'vacation_id',
        'day_count',
    ];

    protected function casts(): array
    {
        return [
            'day_count' => 'integer',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyUser::class, 'company_id');
    }

    public function vacation(): BelongsTo
    {
        return $this->belongsTo(Vacation::class);
    }

    public function branchVacations(): HasMany
    {
        return $this->hasMany(BranchVacation::class);
    }
}
