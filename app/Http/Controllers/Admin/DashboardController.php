<?php

namespace App\Http\Controllers\Admin;

use App\Models\Driver;
use App\Models\JoinUs;
use App\Models\User;
use App\Models\UserWalletTransaction;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('admin.pages.dashboard');
    }

    public function stats(): JsonResponse
    {
        $stats = [
            'users'       => User::count(),
            'drivers'     => Driver::count(),
            'join_us'     => JoinUs::count(),
            'wallet'      => (float) UserWalletTransaction::query()
                ->where('status', 'success')
                ->sum('value'),
        ];

        return $this->success($stats);
    }
}
