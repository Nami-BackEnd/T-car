<?php

namespace App\Http\Requests\Api\User;

class StoreUserWalletRequest extends Request
{
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric', 'min:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => __('validation.amount_required'),
            'amount.numeric'  => __('validation.amount_numeric'),
            'amount.min'      => __('validation.amount_min'),
        ];
    }
}
