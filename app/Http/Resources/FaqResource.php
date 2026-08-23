<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $lang = $request->header('Accept-Language', 'en');

        return [
            'id'         => $this->id,
            'question'   => $lang === 'ar' ? $this->question_ar : $this->question_en,
            'answer'     => $lang === 'ar' ? $this->answer_ar : $this->answer_en,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
