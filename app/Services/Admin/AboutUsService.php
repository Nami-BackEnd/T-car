<?php

namespace App\Services\Admin;

use App\Models\AboutUs;

class AboutUsService extends Service
{
    public function getOrCreateByType(string $type): AboutUs
    {
        return AboutUs::firstOrCreate(
            ['type' => $type],
            ['title_ar' => '', 'title_en' => '', 'content_ar' => '', 'content_en' => '']
        );
    }

    public function updateSections(array $sections): void
    {
        foreach ($sections as $type => $data) {
            if (! in_array($type, ['user', 'driver'])) {
                continue;
            }

            $this->getOrCreateByType($type)->update($data);
        }
    }
}
