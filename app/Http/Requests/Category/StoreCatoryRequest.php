<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseFormRequest;

class StoreCatoryRequest extends BaseFormRequest
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
            'name'      => 'required|max:255|min:3|unique:categories,name',
            'parent_id' => 'nullable|exists:categories,id',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên danh mục !',
            'name.max'      => 'Nhập tối đa 255 kí tự !',
            'name.min'      => 'Nhập tôi thiểu 3 kí tự !',
            'name.unique'   => 'Tên danh mục đã tồn tại !',
            
            'parent_id.exists'     => 'Danh mục cha không tồn tại !'
        ];
    }
}
