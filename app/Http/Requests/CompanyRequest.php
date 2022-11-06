<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => ['required', 'unique:supply_companies,name,' . $this->company_id],
            'email' => ['required', 'email', 'string', 'unique:supply_companies,email,' . $this->company_id],
            'phone' => ['required'],
            'address' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên nhà cung cấp',
            'name.unique' => 'Tên nhà cung cấp đã bị trùng',
            'email.required' => 'Vui lòng nhập emai',
            'email.unique' => 'Email đã bị trùng',
            'email.email' => 'Email không đúng định dạng',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'address.required' => 'Vui lòng nhập địa chỉ',
        ];
    }
}
