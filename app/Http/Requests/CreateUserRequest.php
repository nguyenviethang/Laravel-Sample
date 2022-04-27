<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
            'fullname' => ['required', 'max:30', 'min:3'],
            'email' => ['required', 'unique:users,email', 'email', 'max:255'],
            'avatar' => ['mimes:jpeg,jpg,png', 'max:5120'],
            'phone' => ['regex:/^[0][0-9]{9}$/', 'required'], // Start with 0. Have 10 numbers.
            'birth_day' => ['date_format:Y-m-d', 'required', 'before:today'],
            'start_date' => ['date_format:Y-m-d', 'required', 'before:today'],
            'department_id' => ['required', 'exists:departments,id'],
            'role_id' => ['required', 'exists:roles,id'],
            'status' =>  ['required', Rule::in(config('const.WORK_STATUS'))],
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email không được để trống.',
            'email.unique' => 'Email đã tồn tại trên hệ thống.',
            'email.email' => 'Email không đúng định dạng.',
            'fullname.required' => 'Tên không được để trống.',
            'fullname.min' => 'Tên phải có ít nhất 3 kí tự.',
            'fullname.max' => 'Tên có độ dài nhiều nhất là 30 kí tự.',
            'birth_day.required' => 'Ngày sinh không được để trống.',
            'birth_day.before' => 'Ngày sinh phải sớm hơn ngày hiện tại.',
            'birth_day.date_format' => 'Ngày sinh không đúng định dạng Y-m-d.',
            'phone.required' => 'SĐT không được để trống.',
            'phone.regex' => 'SĐT không đúng định dạng.',
            'avatar.mimes' => 'Hình ảnh phải có đuôi jpeg, jpg, png.',
            'avatar.max' => 'Hình ảnh chỉ được nhỏ hơn 5MB.',
            'status.required' => 'Tình trạng làm việc không để trống.',
            'status.Rule' => 'Tình trạng làm việc không tồn tại trên hệ thống.',
            'start_date.required' => 'Ngày bắt đầu làm việc không được để trống.',
            'start_date.before' => 'Ngày bắt đầu làm việc phải sớm hơn ngày hiện tại.',
            'start_date.date_format' => 'Ngày bắt đầu làm việc không đúng định dạng Y-m-d.',
            'department_id.required' => 'Bộ phận làm việc không được để trống.',
            'department_id.exists' => 'Bộ phận không tồn tại trên hệ thống.',
            'role_id.required' => 'Chức vụ không được để trống.',
            'role_id.exists' => 'Chức vụ không tồn tại trên hệ thống.',
        ];
    }
}
