<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinUs extends Model
{
    protected $table = 'join_us';

    protected $fillable = [
        'name',
        'phone',
        'company_name',
        'email',
        'size',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
