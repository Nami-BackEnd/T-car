<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CarStockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * The availability modal posts one hidden input per company branch, so the
     * payload is an open map: { "<branch id>": "<stock>" }. Branch ownership is
     * still enforced in the service, which is the only place that knows the
     * authenticated company.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'stocks' => ['required', 'array'],
            'stocks.*' => ['required', 'integer', 'min:0', 'max:100000'],
        ];
    }

    public function messages(): array
    {
        return [
            'stocks.required' => __('company.cars.stocks_required'),
            'stocks.*.integer' => __('company.cars.stock_invalid'),
            'stocks.*.min' => __('company.cars.stock_invalid'),
        ];
    }
}
