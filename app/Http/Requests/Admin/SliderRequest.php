<?php

namespace App\Http\Requests\Admin;

class SliderRequest extends Request
{
    public function rules(): array
    {
        return [
            'image' => [$this->isMethod('post') ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'order' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => __('admin.sliders.validation.image_required'),
            'image.image'    => __('admin.sliders.validation.image_image'),
            'image.mimes'    => __('admin.sliders.validation.image_mimes'),
            'image.max'      => __('admin.sliders.validation.image_max'),
            'order.required' => __('admin.sliders.validation.order_required'),
            'order.integer'  => __('admin.sliders.validation.order_integer'),
            'order.min'      => __('admin.sliders.validation.order_min'),
        ];
    }
}
