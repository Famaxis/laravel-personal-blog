<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TemplateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file_name' => [
                'required',
                'max:255',
                Rule::unique('templates', 'file_name')->ignore($this->template)
            ],
            'name'      => 'required',
            'file'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'file_name.unique' => 'File name should be unique',
            'file_name.max'    => 'File name should be shorter',
            'file.required'    => 'Template without template? It makes no sense'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'file_name' => Str::snake($this->file_name),
        ]);
    }
}
