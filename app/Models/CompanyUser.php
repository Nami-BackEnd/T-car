<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CompanyUser extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'password',
        'phone',
        'whatsapp',
        'address',
        'logo',
        'image',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class, 'company_id');
    }

    /**
     * The company profile backing this panel user. When the user has no
     * company_id yet, a profile is created from the user record and linked
     * back onto it, so the panel always has a company to work against.
     */
    public function companyProfile(): Company
    {
        if ($this->company_id !== null && $this->company !== null) {
            return $this->company;
        }

        $company = Company::query()->firstOrCreate(
            ['email' => $this->email],
            [
                'company_name_ar' => $this->name,
                'company_name_en' => $this->name,
                'admin_name' => $this->name,
                'phone' => $this->phone,
            ]
        );

        $this->forceFill(['company_id' => $company->id])->save();

        return $company;
    }
}
