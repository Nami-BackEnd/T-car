<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\AssignLocationRequest;
use App\Http\Requests\Api\User\ChangeLangRequest;
use App\Http\Requests\Api\User\CompleteProfileRequest;
use App\Http\Requests\Api\User\RequestOtpRequest;
use App\Http\Requests\Api\User\UpdateProfileRequest;
use App\Http\Requests\Api\User\VerifyOtpRequest;
use App\Http\Resources\UserResource;
use App\Services\Api\User\UserAuthService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    protected $userService;
    public function __construct(UserAuthService $userService)
    {
        $this->userService = $userService;
    }
    public function requestOtp(RequestOtpRequest $request)
    {
       $data=$request->validated();
      $this->userService->requestOtp($data);
        return ApiResponse::success(
            data: null,
            message: __('user.otp_sent'),
        );
    }
    public function verifyOtp(VerifyOtpRequest $request)
    {
       $data=$request->validated();
       return $this->userService->verifyOtp($data);
    }
    public function completeProfile(CompleteProfileRequest $request)
    {
        $data = $request->validated();
        return $this->userService->completeProfile($request->user(),$data);
    }
    public function assignLocation(AssignLocationRequest $request)
    {
        $data = $request->validated();
        return $this->userService->assignLocation($request->user(), $data);
    }
    public function changeLang(ChangeLangRequest $request)
    {
        $data = $request->validated();
        return $this->userService->changeLang($request->user(), $data);
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        return $this->userService->updateProfile($request->user(), $data);
    }
    public function deleteAccount(Request $request)
    {
        return $this->userService->deleteAccount($request->user());
    }
    public function profile()
    {
        return $this->userService->profile();
    }
}
