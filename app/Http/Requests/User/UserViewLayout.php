<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class UserViewLayout extends BaseFormRequest
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
            "layoutId" => "required|exists:layouts,id"
        ];
    }

    public function messages()
    {
        return [
            "layoutId.required" => 'Vui lòng gửi giao diện !',
            "layoutId.exists"   => 'giao diện không tồn tại !'
        ];
    }
}
