<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ContactUsRequest;
use App\Services\Api\User\ContactUsService;

class ContactUsController extends Controller
{
    public function __construct(private ContactUsService $contactUsService)
    {
    }

    public function store(ContactUsRequest $request)
    {
        return $this->contactUsService->store($request->validated(),'user');
    }
}
