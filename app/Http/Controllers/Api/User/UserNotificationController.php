<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\StoreFcmRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
   public function store(StoreFcmRequest $request)
   {
        return ApiResponse::success(
            message: __('messages.created_successfully'),
        );
   }
}
