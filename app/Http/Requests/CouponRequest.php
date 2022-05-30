<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'coupon_name.required' => 'Trường này không được bỏ trống',
            'coupon_discount' => 'Trường này không được bỏ trống',
            'coupon_validity' => 'Trường này không được bỏ trống',
        ];
    }
}
