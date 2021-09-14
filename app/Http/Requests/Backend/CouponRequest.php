<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'code' => ['required', 'unique:coupons'],
                    'type' => ['required'],
                    'value' => ['required'],
                    'description' => ['nullable'],
                    'use_times' => ['required', 'numeric'],
                    'start_date' => ['nullable', 'date_format:Y-m-d'],
                    'expire_date' => ['required_with:start_date', 'date_format:Y-m-d'],
                    'greater_than' => ['nullable', 'numeric'],
                    'status' => ['required'],
                    'is_public' => ['required']
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'code' => ['required', 'unique:coupons,code,'.$this->route()->coupon->id],
                    'type' => ['required'],
                    'value' => ['required'],
                    'description' => ['nullable'],
                    'use_times' => ['required', 'numeric'],
                    'start_date' => ['nullable', 'date_format:Y-m-d'],
                    'expire_date' => ['required_with:start_date', 'date_format:Y-m-d'],
                    'greater_than' => ['nullable', 'numeric'],
                    'status' => ['required'],
                    'is_public' => ['required']
                ];
            }
            default: break;
        }
    }
}
