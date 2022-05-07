<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'name' => ['required', 'unique:products,name,' . $this->product_id],
            'description' => 'required',
            'product_price' => 'required',
            'product_code' => 'required',
            'product_qty' => 'required',
            'category_id' => 'required',
        ];
    }
}
