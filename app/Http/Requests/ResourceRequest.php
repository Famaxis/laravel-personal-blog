<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResourceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'slug' => [
                'max:255',
                Rule::unique('posts', 'slug')->ignore($this->post),
                Rule::unique('pages', 'slug')->ignore($this->page)
            ]
        ];
    }

    public function messages()
    {
        return [
            'slug.unique' => 'Slug should be unique',
            'slug.max' => 'Slug should be shorter',
        ];
    }
}
