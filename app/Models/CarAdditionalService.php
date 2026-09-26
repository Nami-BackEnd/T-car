<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CarAdditionalService extends Model
{
    protected $fillable = [
        'title_en',
        'title_ar',
    ];

    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class, 'car_services')->withPivot('price');
    }
}
