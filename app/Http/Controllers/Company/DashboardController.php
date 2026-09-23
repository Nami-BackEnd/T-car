<?php

namespace App\Http\Controllers\Company;

use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->page('dashboard', 'dashboard-page');
    }

    public function stats(): JsonResponse
    {
        $stats = [
            'reservations' => 0,
            'cars'         => 0,
            'branches'     => 0,
            'drivers'      => 0,
        ];

        return $this->success($stats);
    }
}