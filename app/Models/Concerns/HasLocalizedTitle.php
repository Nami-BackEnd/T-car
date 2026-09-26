<?php

namespace App\Models\Concerns;

trait HasLocalizedTitle
{
    public function localizedTitle(): string
    {
        return app()->getLocale() === 'en' ? $this->title_en : $this->title_ar;
    }
}
