<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ShippinCompanyRequest extends FormRequest
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
                    'name' => ['required', 'max:255'],
                    'code' => ['required', 'unique:shipping_companies'],
                    'description' => ['required', 'unique:shipping_companies'],
                    'fast' => ['required', 'boolean'],
                    'cost' => ['required', 'numeric'],
                    'status' => ['required', 'boolean'],
                    'countries' => ['required'],
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => ['required', 'max:255'],
                    'code' => ['required', 'unique:shipping_companies,code,'.$this->route()->shipping_company->id],
                    'description' => ['required', 'unique:shipping_companies,description,'.$this->route()->shipping_company->id],
                    'fast' => ['required', 'boolean'],
                    'status' => ['required', 'boolean'],
                    'cost' => ['required', 'numeric'],
                    'countries' => ['required'],
                ];
            }
            default: break;
        }
    }
}
