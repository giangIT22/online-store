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
            'sub_category_name' => ['required', 'string', 'unique:sub_categories,sub_category_name,' . $this->sub_category_id],
            'sub_category_slug' => ['required', 'string', 'unique:sub_categories,sub_category_slug,' . $this->sub_category_id],
            'category_id' => 'required'
        ];
    }
}
