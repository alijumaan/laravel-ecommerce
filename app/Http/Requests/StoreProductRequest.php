<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        return [
            'name'           => 'required',
            'description'    => 'required',
            'details'        => 'required',
            'price'          => 'required|numeric',
            'in_stock'         => 'required',
            'review_able'   => 'required',
            'category_id'    => 'required',
            'images[]'       => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',
        ];
    }
}
