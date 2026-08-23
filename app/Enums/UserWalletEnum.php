<?php

namespace App\Enums;

enum UserWalletEnum: string
{
    case Refund  = 'refund';
    case Payment = 'payment';
    case Topup   = 'topup';
}
