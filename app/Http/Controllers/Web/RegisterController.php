<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Category;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;

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
        $data['name'] = $data['user_name'];
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return redirect()->route('user.login');
    }
}
