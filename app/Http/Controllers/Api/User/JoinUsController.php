<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\JoinUsRequest;
use App\Services\Api\User\JoinUsService;

class JoinUsController extends Controller
{
    public function __construct(private JoinUsService $joinUsService)
    {
    }

    public function store(JoinUsRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        return $this->joinUsService->store($data);
    }
}
