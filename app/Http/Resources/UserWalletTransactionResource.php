<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserWalletTransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'value'      => $this->value,
            'type'     => $this->type->value,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
