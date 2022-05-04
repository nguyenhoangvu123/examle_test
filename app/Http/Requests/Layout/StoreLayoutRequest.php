<?php

namespace App\Http\Requests\Layout;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseFormRequest;

class StoreLayoutRequest extends BaseFormRequest
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
            'name'          => 'required|max:255|min:3|unique:layouts,name',
            'url'           => 'nullable|url',
            'avatar'        => 'required|mimes:jpg,jpeg,png,bmp|max:2048',
            'preview'       => 'nullable|max:255|min:3',
            'orientation'   => 'required|in:1,2'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên giao diện !',
            'name.max'      => 'Tên giao diện Tối đa 3-255 kí tự !',
            'name.min'      => 'Tên giao diện Tối đa 3-255 kí tự !',
            'name.unique'   => 'Tên giao diện đã tồn tại !',

            'url.url'       => 'Tên đường dẫn không đúng !',
            'avatar.mimes'  => 'File không đúng định dạng(jpg,jpeg,png,bmp)',
            'avatar.required'  => 'Vui lòng chọn ảnh giao diện !',
            'avatar.max'    => 'dung lượng file tối đa là 200MB',
            'preview.max'   => 'Nhập tối 3-255 kí tự !',
            'orientation.in' => 'Không tồn tại !',
            'orientation.required' => 'Vui lòng chọn orientation !',

            'category.required' => 'Vui lòng chọn danh mục',
            'category.exists'   => 'Danh mục không tồn tại !'
        ];
    }
}
