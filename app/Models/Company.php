<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

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
        'branch_count',
        'max_late_hours_allowed',
        'insurance_policy_type',
        'insurance_policy_value',
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
            'branch_count' => 'integer',
            'max_late_hours_allowed' => 'integer',
            'insurance_policy_value' => 'decimal:2',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(CompanyUser::class, 'company_id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(CompanyService::class, 'company_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function bankInformation(): HasOne
    {
        return $this->hasOne(CompanyBankInformation::class, 'company_profile_id');
    }

    public function paymentMethods(): BelongsToMany
    {
        return $this->belongsToMany(PaymentMethod::class, 'company_payment_methods', 'company_profile_id', 'payment_method_id');
    }

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'company_cities', 'company_profile_id', 'city_id');
    }

    public function additionalServices(): BelongsToMany
    {
        return $this->belongsToMany(
            CompanyAdditionalService::class,
            'company_services',
            'company_id',
            'company_additional_services_id'
        )->withPivot(['pricing_type', 'price']);
    }

    public function logoUrl(): ?string
    {
        return $this->logo ? Storage::disk('public')->url($this->logo) : null;
    }

    public function commercialImageUrl(): ?string
    {
        return $this->commercial_image ? Storage::disk('public')->url($this->commercial_image) : null;
    }

    public function taxImageUrl(): ?string
    {
        return $this->tax_image ? Storage::disk('public')->url($this->tax_image) : null;
    }
}
