<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyService extends Model
{
    protected $fillable = [
        'company_id',
        'company_additional_services_id',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyUser::class, 'company_id');
    }

    public function additionalService(): BelongsTo
    {
        return $this->belongsTo(CompanyAdditionalService::class, 'company_additional_services_id');
    }
}