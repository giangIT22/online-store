<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => 'required',
            'phone' =>'required|numeric|digits:10',
            'address' =>'required',
            'province' =>'required',
            'district' =>'required',            
            'ward' =>'required',
            'payment_type' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập họ và tên',
            'phone.required' => 'Vui lòng nhập số diện thoại',
            'phone.numeric' => 'Số điện thoại không hợp lệ',
            'phone.numeric' => 'Số điện thoại không hợp lệ',
            'phone.digits' => 'Số điện thoại không hợp lệ',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'province.required' => 'Vui lòng nhập tỉnh thành',
            'district.required' => 'Vui lòng nhập quận, huyện',
            'ward.required' => 'Vui lòng nhập phường xã',
            'payment_type.required' => 'Vui lòng chọn phương thức thanh toán'
        ];
    }
}
