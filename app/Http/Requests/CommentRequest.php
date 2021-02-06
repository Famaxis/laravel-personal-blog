<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'comment' => 'required|min:2|max:1000',
            'name'    => 'max:200'
        ];
    }

    public function messages()
    {
        return [
            'comment.min'      => 'Too short',
            'comment.max'      => 'Too long',
            'name.max'         => 'Too long',
            'comment.required' => 'Text can\'t be empty',
        ];
    }
}
