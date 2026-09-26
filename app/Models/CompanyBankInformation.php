<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyBankInformation extends Model
{
    protected $table = 'company_bank_informations';

    protected $fillable = [
        'company_profile_id',
        'account_owner_name',
        'bank_name',
        'iban_number',
        'account_number',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
