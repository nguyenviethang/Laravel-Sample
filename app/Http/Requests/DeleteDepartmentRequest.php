<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteDepartmentRequest extends FormRequest
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
            'id' => 'required|exists:departments,id|integer',
        ];
    }

    public function messages()
    {
        return  [
            'id.required' => 'Mã phòng ban không được để trống.',
            'id.exists' => 'Mã phòng ban không tồn tại trên hệ thống.',
        ];
    }
}
