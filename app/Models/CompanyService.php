<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyService extends Model
{
    protected $fillable = [
        'company_id',
        'pricing_type',
        'price',
        'company_additional_services_id',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function additionalService(): BelongsTo
    {
        return $this->belongsTo(CompanyAdditionalService::class, 'company_additional_services_id');
    }
}
