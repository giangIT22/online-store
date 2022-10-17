<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\RegisterUserJob;
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
        $confirmCode = time().uniqid(true);
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['confirmation_code'] = $confirmCode;
        $data['confirmed'] = 0;
        User::create($data);

        RegisterUserJob::dispatch($confirmCode, $data['email']);

        $notification = [
            'message' => 'Vui lòng xác nhận email',
            'alert-type' => 'success'
        ];

        return redirect()->route('user.login')->with($notification);
    }

    /**
     * verified email
     */
    public function verify($code)
    {
        $user = User::where('confirmation_code', $code)->first();

        if ($user) {
            $user->update([
                'confirmed' => 1,
                'confirmation_code' => null
            ]);
        }

        $notification = [
            'message' => 'Tài khoản đã được xác nhận',
            'alert-type' => 'success'
        ];

        return redirect()->route('user.login')->with($notification);
    }
}
