<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SupervisorRequest extends FormRequest
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
                    'first_name' => ['required', 'max:255'],
                    'last_name' => ['required', 'max:255'],
                    'username' => ['required', 'max:255', 'unique:users'],
                    'email' => ['required', 'email', 'max:255', 'unique:users'],
                    'phone' => ['required', 'string', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'status' => ['required'],
                    'receive_email' => ['nullable'],
                    'permissions.*' => ['nullable'],
                    'user_image' => ['mimes:jpg,jpeg,png,gif', 'max:20000'],
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'first_name' => ['required', 'max:255'],
                    'last_name' => ['required', 'max:255'],
                    'username' => ['required', 'max:255', 'unique:users,username,'.$this->route()->supervisor->id],
                    'email' => ['required', 'max:255', 'unique:users,email,'.$this->route()->supervisor->id],
                    'phone' => ['required', 'string', 'max:255', 'unique:users,phone,'.$this->route()->supervisor->id],
                    'status' => ['required'],
                    'receive_email' => ['nullable'],
                    'permissions' => ['nullable'],
                    'user_image' => ['mimes:jpg,jpeg,png,gif', 'max:20000'],
                    'password' => ['nullable', 'string', 'min:8'],
                ];
            }
            default: break;
        }
    }
}
