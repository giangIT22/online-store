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
            'coupon_name' => ['required', 'unique:coupons,coupon_name,' . $this->coupon_id],
            'coupon_discount' => 'required|numeric',
            'coupon_validity' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'coupon_name.required' => 'Vui lòng nhập trường này',
            'coupon_discount.required' => 'Vui lòng nhập trường này',
            'coupon_validity.required' => 'Vui lòng nhập trường này',
            'coupon_discount.numeric' => 'Giá trị phải là số',
            'coupon_name.unique' => 'Coupon đã tồn tại'
        ];
    }
}
