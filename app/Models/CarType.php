<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    protected $fillable = [
        'title_ar',
        'title_en',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Locale-aware display title. The lookup tables store both languages, so
     * views read one attribute instead of branching on the locale themselves.
     */
    protected function title(): Attribute
    {
        return Attribute::get(function (): ?string {
            $column = app()->getLocale() === 'ar' ? 'title_ar' : 'title_en';

            return $this->{$column} ?: ($this->title_ar ?: $this->title_en);
        });
    }
}
