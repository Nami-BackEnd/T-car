<?php

namespace App\Services\Api\User;

use App\Enums\UserWalletEnum;
use App\Http\Resources\UserWalletTransactionResource;
use App\Models\User;
use App\Models\UserWalletTransaction;
use App\Traits\ApiResponse;

class UserWalletService
{
    public function index($user, $per_page)
    {
        $transactions = UserWalletTransaction::where('user_id', $user->id)->paginate($per_page);
        $data = [
            'transactions' => UserWalletTransactionResource::collection($transactions),
            'balance'=> $user->balance
        ];
        return ApiResponse::success(
            data:$data,
            message: __('user.wallet_transactions_fetched'),
        );
    }
    public function topup($user, $data)
    {
        $transaction = UserWalletTransaction::create([
            'user_id' => $user->id,
            'value' => $data['amount'],
            'status' => 'pending',
            'type' => UserWalletEnum::Topup,
        ]);
        return $transaction->id;
    }
    public function success($transactionId)
    {
        $transaction = UserWalletTransaction::where('id', $transactionId)->first();
        $transaction->update(['status' => 'success']);
        User::where('id', $transaction->user_id)->increment('balance', $transaction->value);
    }

    public function fail($transactionId)
    {
         $transaction = UserWalletTransaction::where('id', $transactionId)->first();
         $transaction->update(['status' => 'failed']);
    }
}
