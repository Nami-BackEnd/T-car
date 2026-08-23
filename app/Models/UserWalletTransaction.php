<?php

namespace App\Models;

use App\Enums\UserWalletEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWalletTransaction extends Model
{
    protected $table = 'user_wallet_transactions';

    protected $fillable = [
        'user_id',
        'value',
        'type',
        'status',
        'order_id',
    ];

    protected $casts = [
        'value'  => 'decimal:2',
        'type' => UserWalletEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
