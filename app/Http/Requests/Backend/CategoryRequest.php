<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                    'name' => ['required', 'max:255', 'unique:categories'],
                    'status' => ['required'],
                    'parent_id' => ['nullable'],
                    'cover' => ['mimes:jpg,jpeg,png,gif', 'max:20000'],
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => ['required', 'max:255', 'unique:categories,name,'.$this->route()->category->id],
                    'status' => ['required'],
                    'parent_id' => ['nullable'],
                    'cover' => ['mimes:jpg,jpeg,png,gif', 'max:20000'],
                ];
            }
            default: break;
        }

    }
}
