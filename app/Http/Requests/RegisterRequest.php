<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:8'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'お名前を入力してください',
            'name.max'          => 'お名前は8文字以内で入力してください', // 追加
            'email.required'    => 'メールアドレスを入力してください',
            'email.email'       => 'メールアドレスは「ユーザー名@ドメイン」の形式で入力してください',
            'email.unique'      => 'このメールアドレスは既に登録されています',
            'password.required' => 'パスワードを入力してください',
        ];
    }


}
