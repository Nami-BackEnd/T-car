<?php

namespace App\Services\Api\User;

use App\Http\Resources\ContactUsResource;
use App\Models\ContactUs;
use App\Traits\ApiResponse;

class ContactUsService
{
    public function store(array $data, string $model)
    {
        $data['model'] = $model;
        $data['model_id'] = auth()->id();
        $contactUs = ContactUs::create($data);

        return ApiResponse::success(
            message: __('messages.contact_request_created'),
        );
    }
}
