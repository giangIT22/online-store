<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\MailResetPassword;
use App\Models\Category;
use App\Models\User;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }


    public function forgetPassword()
    {
        $categories = Category::with('subcategories')->get();
        return view('auth.web.forget-password', compact('categories'));
    }
    
    public function store(ForgetPasswordRequest $request)
    {
        $data = $this->userService->makeDataVerifyMail($request->input('email'));
        if ($data) {
            Mail::to($data['email'])->send(new MailResetPassword($data));
        }

        $notification = [
            'message' => 'Vui lòng kiếm tra email',
            'alert-type' => 'success'
        ];
     
        return back()->with($notification);
    }

    public function verify(Request $request, $token)
    {
        $user = User::findOrFail($request->user_id);
        $categories = Category::with('subcategories')->get();
        if ($user
            && Hash::check(sprintf('%s%s', $user->id, $user->email), $token)
            && now()->lessThan($user->email_verified_at->addDays(1))
        ) {
            return view('auth.web.change-password', [
                'userId' => $user->id,
                'categories' => $categories
            ]);
        }

        return redirect()->route('user.login');
    }

    public function updatePassword(ResetPasswordRequest $request, $userId)
    {
        $user = User::findOrFail($userId);

        if ($user) {
            $user->password = Hash::make($request->new_password);
            $user->save();
        }

        $notification = [
            'message' => 'Cập nhật mật khẩu thành công',
            'alert-type' => 'success'
        ];

     
        return redirect()->route('user.login')->with($notification);
    }
}
