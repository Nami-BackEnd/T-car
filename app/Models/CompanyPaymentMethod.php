<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyPaymentMethod extends Model
{
    protected $fillable = [
        'company_profile_id',
        'payment_method_id',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_profile_id');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}