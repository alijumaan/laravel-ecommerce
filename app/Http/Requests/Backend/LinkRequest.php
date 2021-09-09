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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'title' => ['required', 'string', 'max:255', 'unique:links'],
                    'as' => ['required', 'string', 'max:255', 'unique:links'],
                    'to' => ['required', 'string', 'max:255', 'unique:links'],
                    'icon' => ['required', 'max:255', 'string'],
                    'permission_title' => ['required', 'string', 'max:255', 'unique:links'],
                    'status' => ['required'],
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title' => ['required', 'string', 'max:255', 'unique:links,title,'.$this->route()->link->id],
                    'as' => ['required', 'string', 'max:255', 'unique:links,as,'.$this->route()->link->id],
                    'to' => ['required', 'string', 'max:255', 'unique:links,to,'.$this->route()->link->id],
                    'icon' => ['required', 'max:255', 'string'],
                    'permission_title' => ['required', 'string', 'max:255', 'unique:links,permission_title,'.$this->route()->link->id],
                    'status' => ['required'],
                ];
            }
            default: break;
        }
    }
}
