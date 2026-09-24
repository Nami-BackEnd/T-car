<?php

namespace App\Services\Admin;

use App\Models\ClientInstruction;

class ClientInstructionService extends Service
{
    public function getOrCreateByType(string $type): ClientInstruction
    {
        return ClientInstruction::firstOrCreate(
            ['type' => $type],
            ['content_ar' => '', 'content_en' => '']
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
