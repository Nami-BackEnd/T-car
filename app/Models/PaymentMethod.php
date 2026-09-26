<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedTitle;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasLocalizedTitle;

    protected $fillable = [
        'title_ar',
        'title_en',
        'icon',
    ];
}
