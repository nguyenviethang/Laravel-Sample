<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'new_password' => ['required', 'min:6', 'max:30', 'regex:/(?=.*[A-Za-z])(?=.*\d)(?=.*[ !"#$%&\'()*+,-.\/:;<=>?@[\]^_`{|}~])/'],
            'password_confirmed' => 'required|same:new_password',
        ];
    }

    public function messages()
    {
        return  [
            'old_password.required' => 'Mật khẩu cũ không được để trống.',
            'new_password.required' => 'Mật khẩu không được để trống. ',
            'new_password.min' => 'Mật khẩu phải có ít nhất 6 kí tự.',
            'new_password.max' => 'Mật khẩu có độ dài tối đa là 30 kí tự.',
            'new_password.regex' => 'Mật khẩu tối thiểu 6 kí tự bao gồm chữ hoa, chữ thường, số và kí tự đặc biệt.',
            'password_confirmed.required' => 'Xác nhận mật khẩu không được để trống.',
            'password_confirmed.same' => 'Mật khẩu xác nhận không trùng mật khẩu mới.'
        ];
    }
}
