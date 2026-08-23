<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Requests\Api\Driver\ContactUsRequest;
use App\Services\Api\Driver\ContactUsService;

class ContactUsController extends Controller
{
    public function __construct(private ContactUsService $contactUsService)
    {
    }

    public function store(ContactUsRequest $request)
    {
        return $this->contactUsService->store($request->validated());
    }
}
