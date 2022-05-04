<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;

class LoginRequest extends BaseFormRequest
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
            'email' => 'required|email|min:6|max:100',
            'password'  => 'required|min:3', 
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'Vui lòng nhập email !',
            'email.min'         => 'Nhập tối thiểu 6 ký tự !',
            'email.max'         => 'Nhập tối đa 100 ký tự !',
            'email.email'       => 'Email không đúng định dạng !',

            'password.required' => 'Vui lòng nhập mật khẩu !'
        ];
    }
}
