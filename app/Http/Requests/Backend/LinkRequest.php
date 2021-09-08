<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'as' => ['required', 'string'],
            'to' => ['required', 'string'],
            'icon' => ['required', 'string'],
            'permission_title' => ['required', 'string'],
            'status' => ['required'],
        ];
    }
}
