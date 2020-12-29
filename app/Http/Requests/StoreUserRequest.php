<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'          => 'required',
            'username'      => 'required|max:20|unique:users',
            'email'         => 'required|email|unique:users',
            'mobile'        => 'required|numeric|unique:users',
            'role_id'        => 'required',
            'status'        => 'required',
            'receive_email' => 'required',
            'password'      => 'required|min:8',
        ];
    }
}
