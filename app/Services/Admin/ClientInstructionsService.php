<?php

namespace App\Services\Admin;

use App\Models\ClientInstructions;

class ClientInstructionsService extends Service
{
    public function get(): ClientInstructions
    {
        return ClientInstructions::firstOrCreate([], [
            'content_ar' => '',
            'content_en' => '',
        ]);
    }

    public function update(array $data): ClientInstructions
    {
        $item = $this->get();
        $item->update($data);

        return $item->refresh();
    }
}
