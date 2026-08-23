<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'phone'        => $this->phone,
            'email'        => $this->email,
            'phone_code'   => $this->phone_code,
            'birth_date'   => $this->birth_date?->format('Y-m-d'),
            'license' => new UserLicenseResource($this->whenLoaded('licenses')),
            'created_at'   => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
