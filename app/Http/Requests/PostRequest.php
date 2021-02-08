<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
                Rule::unique('posts', 'slug')->ignore($this->post)
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
