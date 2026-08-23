<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                        => $this->id,
            'name'                      => $this->name,
            'assigned_to_all_branches'  => $this->assigned_to_all_branches,
            'phone_code'                => $this->phone_code,
            'phone'                     => $this->phone,
            'license_expiration_date'   => $this->license_expiration_date?->format('Y-m-d'),
            'identity_number'           => $this->identity_number,
            'email'                     => $this->email,
            'created_at'                => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
