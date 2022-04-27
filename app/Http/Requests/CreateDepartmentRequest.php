<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDepartmentRequest extends FormRequest
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
            'name' => 'required|min:3|max:50|unique:departments,name',
            'description' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return  [
            'name.required' => 'Tên phòng ban không được để trống.',
            'name.min' => 'Tên phòng ban phải có ít nhất 3 ký tự.',
            'name.max' => 'Tên phòng ban không được vượt quá 50 ký tự.',
            'name.unique' => 'Tên phòng ban đã tồn tại.',
            'description.required' => 'Mô tả phòng ban không được để trống.',
            'description.max' => 'Mô tả phòng ban không được vượt quá 255 ký tự.',
        ];
    }
}
