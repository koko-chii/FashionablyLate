<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => ['sometimes', 'required', 'exists:contacts,id'],
            'keyword'     => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'in:1,2,3,all'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'date'        => ['nullable', 'date'],
        ];
    }
}
