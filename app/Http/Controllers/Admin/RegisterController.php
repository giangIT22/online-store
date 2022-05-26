<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.admin.register');
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->all();
        $data['name'] = $data['user_name'];
        $data['password'] = Hash::make($data['password']);
        $admin = Admin::create($data);
        return redirect()->route('admin.login');
    }
}
