<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JoinUsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'phone'        => $this->phone,
            'company_name' => $this->company_name,
            'email'        => $this->email,
            'size'         => $this->size,
            'created_at'   => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
