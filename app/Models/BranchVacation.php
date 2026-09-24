<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BranchVacation extends Model
{
    protected $fillable = [
        'branch_id',
        'company_vacation_id',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function companyVacation(): BelongsTo
    {
        return $this->belongsTo(CompanyVacation::class);
    }
}
