<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
        'first_name' => ['required', 'string', 'max:8'],
        'last_name'  => ['required', 'string', 'max:8'],
        'gender'     => ['required'],
        'email'      => ['email', 'required'],
        'tel1'        => ['required', 'numeric', 'digits_between:1,5'],
        'tel2'        => ['required', 'numeric', 'digits_between:1,5'],
        'tel3'        => ['required', 'numeric', 'digits_between:1,5'],
        'address'    => ['required'],
        'category_id'=> ['required'],
        'detail'     => ['required', 'max:120'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => '姓を入力してください',
            'first_name.string'   => '姓は文字列で入力してください',
            'first_name.max'      => '姓は8文字以内で入力してください',
            'last_name.required'  => '名を入力してください',
            'last_name.string'    => '名は文字列で入力してください',
            'last_name.max'       => '名は8文字以内で入力してください',
            'gender.required'     => '性別を選択してください',
            'email.required'      => 'メールアドレスを入力してください',
            'email.email'         => 'メールアドレスはメール形式で入力してください',
            'tel.required'       => '電話番号を入力してください',
            'tel.numeric'        => '電話番号は半角数字で入力してください',
            'tel1.required' => '電話番号を入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel1.digits_between' => '電話番号は5桁以内で入力してください',
            'tel2.digits_between' => '電話番号は5桁以内で入力してください',
            'tel3.digits_between' => '電話番号は5桁以内で入力してください',
            'tel1.numeric' => '電話番号は半角数字で入力してください',
            'tel2.numeric' => '電話番号は半角数字で入力してください',
            'tel3.numeric' => '電話番号は半角数字で入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required'     => 'お問い合わせ内容を入力してください',
            'detail.max'          => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
