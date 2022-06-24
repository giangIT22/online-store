<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
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
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                config('fortify.guard') == 'admin' ? 'unique:admins,email' : 'unique:users,email',
            ],
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.string' => 'Email phải là một chuỗi kí tự',
            'email.required' => 'Vui lòng nhập email',
            'name.required' => 'Vui lòng nhập tên',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'user_name.string' => 'Tên phải là một chuỗi kí tự',
            'email.email' => 'Mail không đúng định dạng',
            'email.unique' => 'Email này đã tồn tại'
        ];
    }
}
