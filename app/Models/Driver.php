<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'drivers';

    protected $fillable = [
        'company_id',
        'name',
        'assigned_to_all_branches',
        'phone_code',
        'phone',
        'license_expiration_date',
        'identity_number',
        'email',
        'password',
        'lang',
        'is_verified',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
        'assigned_to_all_branches' => 'boolean',
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
        'license_expiration_date' => 'date',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyUser::class, 'company_id');
    }

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'driver_branches', 'driver_id', 'branch_id');
    }

    public function scopeForCompany(Builder $query, int $companyId): Builder
    {
        return $query->where('company_id', $companyId);
    }

    /**
     * Localized branch names for display and export.
     */
    public function branchNames(): Collection
    {
        $isArabic = app()->getLocale() === 'ar';

        return $this->branches->map(
            fn (Branch $branch) => $isArabic ? $branch->name_ar : $branch->name_en
        );
    }
}
