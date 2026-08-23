<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Requests\Api\Driver\DriverAuthRequest;
use App\Http\Requests\Api\Driver\VerifyOtpRequest;
use App\Http\Requests\Api\Driver\ChangeLangRequest;
use App\Services\Api\Driver\DriverAuthService;
use App\Traits\ApiResponse;

class DriverAuthController extends Controller
{
    protected $driverAuthService;

    public function __construct(DriverAuthService $driverAuthService)
    {
        $this->driverAuthService = $driverAuthService;
    }

    public function login(DriverAuthRequest $request)
    {
        $data = $request->validated();
        return $this->driverAuthService->login($data);
    }
    public function verifyOtp(VerifyOtpRequest $request)
    {
       $data=$request->validated();
       return $this->driverAuthService->verifyOtp($data);
    }
    public function changeLang(ChangeLangRequest $request)
    {
        $data = $request->validated();
        return $this->driverAuthService->changeLang($request->user(), $data);
    }
}
