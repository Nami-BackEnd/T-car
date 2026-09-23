<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    protected $fillable = [
        'daily_booking_showing',
        'monthly_booking_showing',
        'station_booking_showing',
        'airport_booking_showing',
        'international_booking_showing',
        'rewards_screen_showing',
        'free_cancellation_time',
        'partial_cancellation_time',
        'partial_cancellation_percentage',
        'number_days_of_refund',
        'tax_value',
        'riyal_to_points_conversion',
        'driver_reword_value',
        'logo',
    ];

    protected $casts = [
        'daily_booking_showing' => 'boolean',
        'monthly_booking_showing' => 'boolean',
        'station_booking_showing' => 'boolean',
        'airport_booking_showing' => 'boolean',
        'international_booking_showing' => 'boolean',
        'rewards_screen_showing' => 'boolean',
        'free_cancellation_time' => 'integer',
        'partial_cancellation_time' => 'integer',
        'partial_cancellation_percentage' => 'decimal:2',
        'number_days_of_refund' => 'integer',
        'tax_value' => 'decimal:2',
        'riyal_to_points_conversion' => 'decimal:2',
        'driver_reword_value'        => 'decimal:2',
    ];

    protected $appends = ['logo_url'];

    public function getLogoUrlAttribute(): string
    {
        return $this->logo ? Storage::disk('public')->url($this->logo) : '';
    }
}
