<?php

namespace App\Services\Api\Driver;

use App\Http\Resources\DriverResource;
use App\Models\Driver;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use App\Services\Api\General\OtpService;

class DriverAuthService
{
    protected $otpService;
    public function __construct(OtpService  $otpService)
    {
        $this->otpService = $otpService;
    }
    public function login($data)
    {
        $driver = Driver::where('phone', $data['phone'])
            ->where('phone_code', $data['phone_code'])
            ->first();

        if (! $driver || ! isset($data['password'])) {
            return ApiResponse::error(
                message: __('driver.invalid_credentials'),
                code: 422
            );
        }
        if (! Hash::check($data['password'], $driver->password)) {
            return ApiResponse::error(
                message: __('driver.invalid_credentials'),
                code: 422
            );
        }
        if ($driver->is_verified == 0) {
            $this->sendVerificationOtp($driver);
            $data = [
                'is_verified' => $driver->is_verified ? 1 : 0
            ];
            return ApiResponse::success(
                data: $data,
                message: __('driver.otp_sent'),
            );
        }

        $token = $driver->createToken('auth_token')->plainTextToken;

        $data = [
            'driver' => new DriverResource($driver),
            'is_verified' => $driver->is_verified ? 1 : 0,
            'token'  => $token,
        ];

        return ApiResponse::success(
            data: $data,
            message: __('driver.login_success'),
        );
    }
    public function sendVerificationOtp($driver)
    {
        $otp = $this->otpService->generateOtp($driver->phone, $driver->phone_code, 'login', 'driver');
        // send otp 
        return $otp;
    }
    public function verifyOtp($data)
    {
        $data['type'] = 'driver';
        $data['otp_type'] = 'login';
        $checkOtp = $this->otpService->checkVerificationOtp($data);
        if (!$checkOtp) {
            return ApiResponse::error(
                message: __('user.invalid_otp'),
                code: 422
            );
        }
        $driver = Driver::where('phone', $data['phone'])
            ->where('phone_code', $data['phone_code'])
            ->first();
        $driver->is_verified = 1;
        $driver->save();

        $token = $driver->createToken('auth_token')->plainTextToken;
        $data = [
            'driver' => new DriverResource($driver),
            'is_verified' => $driver->is_verified ? 1 : 0,
            'token'  => $token,
        ];

        return ApiResponse::success(
            data: $data,
            message: __('driver.login_success'),
        );
    }

    public function changeLang($driver, $data)
    {
        $driver->update(['lang' => $data['lang']]);

        return ApiResponse::success(
            data: ['driver' => new DriverResource($driver)],
            message: __('driver.lang_updated'),
        );
    }
}
