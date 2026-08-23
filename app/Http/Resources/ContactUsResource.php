<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'model'        => $this->model,
            'model_id'     => $this->model_id,
            'name'         => $this->name,
            'email'        => $this->email,
            'reason'       => $this->reason,
            'order_number' => $this->order_number,
            'message'      => $this->message,
            'created_at'   => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
