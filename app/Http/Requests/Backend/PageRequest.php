<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
                    'title' => ['required', 'string', 'max:255', 'unique:pages'],
                    'slug' => ['required', 'string', 'max:255', 'unique:pages'],
                    'content' => ['required'],
                    'status' => ['required'],
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title' => ['required', 'string', 'max:255', 'unique:pages,title,'.$this->route()->page->id],
                    'slug' => ['required', 'string', 'max:255', 'unique:pages,slug,'.$this->route()->page->id],
                    'content' => ['required'],
                    'status' => ['required'],
                ];
            }
            default: break;
        }
    }
}
