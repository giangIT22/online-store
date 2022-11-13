<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:admins,email,' . $this->employee_id,
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'cccd' => 'required|numeric|digits_between:9,12|unique:admins,cccd,' . $this->employee_id,
            'role_id' =>'required',
            'password_confirmation' => 'same:password'
        ];
    }
    
    public function messages()
    {
        return [
            'email.string' => 'Email phải là một chuỗi kí tự',
            'email.required' => 'Vui lòng nhập email',
            'name.required' => 'Vui lòng nhập tên',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'name.string' => 'Tên phải là một chuỗi kí tự',
            'email.email' => 'Mail không đúng định dạng',
            'email.unique' => 'Email này đã tồn tại',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'cccd.required' => 'Vui lòng nhập số căn cước',
            'password_confirmation.same' => 'Mật khẩu nhập lại không chính xác',
            'role_id.required' => 'Vui lòng chọn vai trò',
            'cccd.digits_between' => 'Số căn cước phải từ 9 đến 12 kí tự',
            'cccd.numeric' => 'Căn cước công dân phải là số'
        ];
    }
}
