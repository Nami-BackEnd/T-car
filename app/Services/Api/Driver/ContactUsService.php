<?php

namespace App\Services\Api\Driver;

use App\Models\ContactUs;
use App\Traits\ApiResponse;

class ContactUsService
{
    use ApiResponse;

    public function store(array $data)
    {
        $data['model'] = 'driver';
        $data['model_id'] = auth()->id();
        $data['lang'] = app()->getLocale();
        ContactUs::create($data);

        return ApiResponse::success(
            message: __('messages.contact_request_created'),
        );
    }
}
