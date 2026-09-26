<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Branch extends Model
{
    protected $fillable = [
        'company_id',
        'branch_type',
        'name_ar',
        'name_en',
        'person_name',
        'person_email',
        'phone_code',
        'phone_number',
        'general_phone_code',
        'general_phone_number',
        'address',
        'latitude',
        'longitude',
        'is_airport_branch',
        'is_train_station_branch',
        'notes_ar',
        'notes_en',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'is_airport_branch' => 'boolean',
            'is_train_station_branch' => 'boolean',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyUser::class, 'company_id');
    }

    public function drivers(): BelongsToMany
    {
        return $this->belongsToMany(Driver::class, 'driver_branches', 'branch_id', 'driver_id');
    }

    public function airports(): BelongsToMany
    {
        return $this->belongsToMany(Airport::class, 'branch_airports');
    }

    public function trainStations(): BelongsToMany
    {
        return $this->belongsToMany(TrainStation::class, 'branch_train_stations');
    }

    public function workingHours(): HasMany
    {
        return $this->hasMany(BranchWorkingHour::class);
    }

    public function deliveryHours(): HasMany
    {
        return $this->hasMany(BranchDeliveryHour::class);
    }

    public function driverService(): HasOne
    {
        return $this->hasOne(BranchDriverService::class);
    }

    public function childSeatService(): HasOne
    {
        return $this->hasOne(BranchChildSeatService::class);
    }

    public function airportFastDelivery(): HasOne
    {
        return $this->hasOne(AirportFastDelivery::class);
    }

    public function specialDeliveryService(): HasOne
    {
        return $this->hasOne(BranchSpecialDeliveryService::class);
    }

    public function deliveryOnlyPrices(): HasMany
    {
        return $this->hasMany(BranchDeliveryOnlyPrice::class);
    }

    public function branchVacations(): HasMany
    {
        return $this->hasMany(BranchVacation::class);
    }
}
