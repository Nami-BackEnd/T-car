<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\StoreUserWalletRequest;
use App\Models\UserWalletTransaction;
use App\Services\Api\User\UserWalletService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserWalletContorller extends Controller
{
    public function __construct(protected UserWalletService $userWalletService){}

    public function index(Request $request)
    {
        return $this->userWalletService->index($request->user(), $request->per_page);
    }

    public function store(StoreUserWalletRequest $request)
    {
        $data = $request->validated();
        $transactionId = $this->userWalletService->topup($request->user(), $data);
        return ApiResponse::success(
            data: [
                'payment_url' => route('pay.wallet', [
                    'transactionId' => $transactionId,
                ]),

                'success_url' => route('success.wallet', [
                    'transactionId' => $transactionId,
                ]),

                'fail_url' => route('fail.wallet', [
                    'transactionId' => $transactionId,
                ]),
            ],
            message: __('user.wallet_topup_url'),
        );
    }

    public function pay($transactionId)
    {
        $transaction = UserWalletTransaction::findOrFail($transactionId);
        return view('payment', compact('transaction'));
    }

    public function success($transactionId)
    {
        $this->userWalletService->success($transactionId);
        return view('payment-success');
    }

    public function fail($transactionId)
    {
        $this->userWalletService->fail($transactionId);
        return view('payment-fail');
    }
}
