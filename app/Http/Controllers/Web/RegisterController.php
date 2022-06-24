<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $categories = Category::with('subCategories')->get();

        return view('auth.web.register', compact('categories'));
    }

    public function store(RegisterRequest $request, User $creator)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        
        return redirect()->route('user.login');
    }
}
