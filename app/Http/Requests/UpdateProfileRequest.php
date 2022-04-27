<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'avatar' => ['mimes:jpeg,jpg,png', 'max:5120'],
            'phone' => ['regex:/^[0][0-9]{9}$/', 'required'], // Start with 0. Have 10 numbers.
            'birth_day' => ['date_format:Y-m-d', 'required', 'before:today'],
            'oldAvatar' => ['nullable']
        ];
    }
    public function messages()
    {
        return [
            'birth_day.required' => 'Ngày sinh không được để trống.',
            'birth_day.before' => 'Ngày sinh phải sớm hơn ngày hiện tại.',
            'birth_day.date_format' => 'Ngày sinh không đúng định dạng Y-m-d.',
            'phone.required' => 'SĐT không được để trống.',
            'phone.regex' => 'SĐT không đúng định dạng.',
            'avatar.mimes' => 'Hình ảnh phải có đuôi jpeg, jpg, png.',
            'avatar.max' => 'Hình ảnh chỉ được nhỏ hơn 5MB.'
        ];
    }
}
