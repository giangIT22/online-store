<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'sub_category_name' => ['required', 'string'],
            'sub_category_slug' => ['required', 'string'],
            'category_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'sub_category_name.required' => 'Vui lòng nhập trường này',
            'sub_category_slug.required' => 'Vui lòng nhập trường này',
            'category_id.required' => 'Vui lòng nhập trường này'
        ];
    }
}
