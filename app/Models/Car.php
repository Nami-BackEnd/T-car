<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Car extends Model
{
    protected $fillable = [
        'image',
        'car_brand_id',
        'car_type_id',
        'car_model_id',
        'year',
        'count',
        'note_ar',
        'note_en',
        'is_subscriber',
        'is_active',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : '';
    }

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'count' => 'integer',
            'is_subscriber' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'car_brand_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(CarType::class, 'car_type_id');
    }

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    public function pricing(): HasOne
    {
        return $this->hasOne(CarPricing::class);
    }

    public function details(): HasOne
    {
        return $this->hasOne(CarDetail::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(CarSubscription::class);
    }

    public function carServices(): HasMany
    {
        return $this->hasMany(CarService::class);
    }

    public function carBranches(): HasMany
    {
        return $this->hasMany(CarBranch::class);
    }

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'car_branches')->withPivot('stock');
    }

    public function additionalServices(): BelongsToMany
    {
        return $this->belongsToMany(CarAdditionalService::class, 'car_services')->withPivot('price');
    }
}
