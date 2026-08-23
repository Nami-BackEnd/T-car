<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserLicenseRequest;
use App\Services\Api\User\UserLicenseService;

class UserLicenseController extends Controller
{
    public function __construct(private UserLicenseService $userLicenseService){}

    public function show()
    {
        return $this->userLicenseService->show(auth('user')->user());
    }

    public function store(UserLicenseRequest $request)
    {
        $data = $request->validated();
    
        return $this->userLicenseService->store($request->user(),$data);
    }
}
