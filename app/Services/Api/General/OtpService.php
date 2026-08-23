<?php

namespace App\Services\Api\General;

use App\Models\Otp;

class OtpService
{

    public function generateOtp($phone, $phone_code,$otp_type, $userType)
    {
        // $otp=rand(1000,9999);
        $otp = 1234;
        Otp::updateOrCreate(
            [   'phone' => $phone ,
                'phone_code' => $phone_code ,
                'type' => $userType,
                'is_used' => false,
                'otp_type' => $otp_type
            ],
            [  
                'otp' => $otp,
                'expire_at' => now()->addMinutes(1),
            ]
       
        );
        return $otp;
    }
    public function checkVerificationOtp($data)
    {
        $checkOtp = Otp::where('phone', $data['phone'])->where('phone_code', $data['phone_code'])
            ->where('type', $data['type'])->where('otp', $data['otp'])->where('otp_type', $data['otp_type'])->where('is_used', false)
            ->where('expire_at', '>', now())->first();
        if (!$checkOtp) {
            return false;

        }
        $checkOtp->is_used = true;
        $checkOtp->save();
        return true;
    }
}
