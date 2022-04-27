<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'id' => ['required', 'exists:users,id']
        ];
    }
    public function messages()
    {
        return  [
            'id.required' => 'Mã nhân viên không được để trống.',
            'id.exists' => 'Mã nhân viên không tồn tại trên hệ thống.',
        ];
    }
}
