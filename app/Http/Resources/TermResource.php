<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TermResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $lang = $request->header('Accept-Language', 'en');

        return [
            'id'         => $this->id,
            'type'       => $this->type,
            'title'      => $lang === 'ar' ? $this->title_ar : $this->title_en,
            'content'    => $lang === 'ar' ? $this->content_ar : $this->content_en,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
