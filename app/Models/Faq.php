<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'type',
        'question_ar',
        'question_en',
        'answer_ar',
        'answer_en',
    ];

    protected $casts = [
        'type' => 'string',
    ];
    protected $appends = ['question', 'answer'];
    public function getQuestionAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->question_ar : $this->question_en;
    }

    public function getAnswerAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->answer_ar : $this->answer_en;
    }
}
