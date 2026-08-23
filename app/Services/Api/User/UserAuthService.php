<?php

namespace App\Services\Api\User;

use App\Http\Resources\UserResource;
use App\Models\Otp;
use App\Models\User;
use App\Services\Api\General\OtpService;
use App\Traits\ApiResponse;

class UserAuthService
{
    protected $otpService;
    public function __construct(OtpService  $otpService)
    {
        $this->otpService = $otpService;
    }
    public function requestOtp($data)
    {
        $otp = $this->otpService->generateOtp($data['phone'], $data['phone_code'], $data['otp_type'], 'user');
        // send otp 
        return $otp;
    }
    public function verifyOtp($data)
    {
        if ($data['otp_type'] !== 'login') {
             if (!auth('user')->check()) {
            return ApiResponse::unauthorized();
        }
        }
        $data['type'] ='user';
        $checkOtp = $this->otpService->checkVerificationOtp($data);
        if (!$checkOtp) {
            return ApiResponse::error(
                    message: __('user.invalid_otp'),
                    code: 422
                );
        }
        if ($data['otp_type'] == 'login') {
            return $this->login($data);
        } else {
            return $this->updatePhone($data['phone']);
        }
    }
    public function updatePhone($phone)
    {
        $user = auth('user')->user();
        $user->update(['phone' => $phone]);
        return $this->profile();
    }
    public function login($data)
    {
        $new_user = false;
        $user = User::where('phone', $data['phone'])->where('phone_code', $data['phone_code'])->first();
        if (!$user) {
            $user = User::create([
                'phone' => $data['phone'],
                'phone_code' => $data['phone_code'],
            ]);
            $new_user = true;
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        $currentStep = $new_user ? 'register' : $user->current_step;
        $data = [
            'user' => new UserResource($user),
            'token' => $token,
            'new_user' => $new_user,
            'current_step' => $currentStep
        ];

        return ApiResponse::success(
            data: $data,
            message: __('user.otp_verified'),
        );
    }
    public function completeProfile($user, $data)
    {
        $user->update($data);
        $user->current_step = 'location';
        $user->save();
        $data = [
            'user' => new UserResource($user),
            'current_step' => 'location',
        ];

        return ApiResponse::success(
            data: $data,
            message: __('user.profile_updated'),
        );
    }
    public function assignLocation($user, $data)
    {
        $user->update($data);
        $user->current_step = 'completed';
        $user->save();
        $data = [
            'user' => new UserResource($user),
            'current_step' => $user->current_step,
        ];

        return ApiResponse::success(
            data: $data,
            message: __('user.location_saved'),
        );
    }
    public function changeLang($user, $data)
    {
        $user->update(['lang' => $data['lang']]);
        $data = [
            'user' => new UserResource($user),
        ];

        return ApiResponse::success(
            data: $data,
            message: __('user.lang_updated'),
        );
    }
    public function updateProfile($user, $data)
    {
        $user->update($data);
        $data = [
            'user' => new UserResource($user),
        ];

        return ApiResponse::success(
            data: $data,
            message: __('user.profile_updated'),
        );
    }
    public function deleteAccount($user)
    {
        $user->tokens()->delete();
        $user->delete();

        return ApiResponse::success(
            data: null,
            message: __('user.account_deleted'),
        );
    }
    public function profile()
    {
        $user = auth('user')->user();
        $user->load('licenses');
        $data = [
            'user' => new UserResource($user),
        ];
        return ApiResponse::success(
            data: $data,
            message: __('user.profile'),
        );
    }
}
