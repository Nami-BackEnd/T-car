<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'company_name_ar',
        'company_name_en',
        'admin_name',
        'email',
        'phone',
        'phone_code',
        'license_category',
        'max_late_hours_allowed',
        'insurance_policy_id',
        'address',
        'city_id',
        'country_id',
        'latitude',
        'longitude',
        'logo',
        'commercial_record',
        'commercial_image',
        'tax_number',
        'tax_image',
    ];

    protected function casts(): array
    {
        return [
            'max_late_hours_allowed' => 'integer',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function bankInformation(): HasMany
    {
        return $this->hasMany(CompanyBankInformation::class, 'company_profile_id');
    }

    public function paymentMethods(): BelongsToMany
    {
        return $this->belongsToMany(PaymentMethod::class, 'company_payment_methods', 'company_profile_id', 'payment_method_id');
    }

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'company_cities', 'company_profile_id', 'city_id');
    }
}