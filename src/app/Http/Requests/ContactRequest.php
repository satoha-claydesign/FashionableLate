<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            //
            'last_name' => ['required', 'string', 'max:8'],
            'first_name' => ['required', 'string', 'max:8'],
            'gender' => ['required'],
            'email' => ['required', 'email'],
            'tel01' => ['required', 'numeric', 'digits_between:1,5'],
            'tel02' => ['required', 'numeric', 'digits_between:1,5'],
            'tel03' => ['required', 'numeric', 'digits_between:1,5'],
            'address' => ['required'],
            'category_id' => ['exists:categories,id'],
            'detail' => ['required', 'max:120']
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'last_name.string' => '姓を文字列で入力してください',
            'last_name.max' => '姓を8文字以下で入力してください',
            'first_name.required' => '名を入力してください',
            'first_name.string' => '名を文字列で入力してください',
            'first_name.max' => '名を8文字以下で入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel01.required' => '電話番号1を入力してください',
            'tel01.numeric' => '電話番号1を半角数字で入力してください',
            'tel01.digits_between' => '電話番号1を5桁までの値で入力してください',
            'tel02.required' => '電話番号2を入力してください',
            'tel02.numeric' => '電話番号2を半角数字で入力してください',
            'tel02.digits_between' => '電話番号2を5桁までの値で入力してください',
            'tel03.required' => '電話番号3を入力してください',
            'tel03.numeric' => '電話番号3を半角数字で入力してください',
            'tel03.digits_between' => '電話番号3を5桁までの値で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.exists' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容を120文字以下で入力してください',
        ];
    }
}