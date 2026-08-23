<?php

namespace App\Services\Api\User;

use App\Models\JoinUs;
use App\Traits\ApiResponse;

class JoinUsService
{
    public function store(array $data)
    {
        JoinUs::create($data);
      

        return ApiResponse::success(
            message: __('messages.join_us_created'),
        );
    }
}
