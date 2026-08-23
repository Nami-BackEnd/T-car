<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';

    protected $fillable = [
        'model',
        'model_id',
        'name',
        'email',
        'reason',
        'order_number',
        'message',
        'lang',
    ];
}
