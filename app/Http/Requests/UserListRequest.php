<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserListRequest extends FormRequest
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
            'item_per_page' => [Rule::in(config('const.ITEM_PER_PAGE'))],
            'department_id' => ['nullable', 'integer', 'exists:departments,id'],
            'keyword' => ['nullable', 'string'],
            'status' => ['nullable', Rule::in(config('const.WORK_STATUS'))],
            'sort_by' => ['nullable', Rule::in(config('const.SORT_BY'))],
            'role_id' => ['nullable', 'exist:roles,id']
        ];
    }
}
