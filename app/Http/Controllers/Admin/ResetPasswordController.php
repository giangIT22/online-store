<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminForgetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\AdminMailResetPassword;
use App\Models\Admin;
use App\Models\User;
use App\Services\AdminServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    protected $adminService;

    public function __construct(AdminServiceInterface $adminService)
    {
        $this->adminService = $adminService;
    }

    public function forgetPassword()
    {
        return view('auth.admin.forget-password');
    }
    
    public function store(AdminForgetPasswordRequest $request)
    {
        $data = $this->adminService->makeDataVerifyMail($request->input('email'));
        if ($data) {
            Mail::to($data['email'])->send(new AdminMailResetPassword($data));
        }

        $notification = [
            'message' => 'Vui lòng kiếm tra email',
            'alert-type' => 'success'
        ];
     
        return back()->with($notification);
    }

    public function verifyEmail(Request $request, $token)
    {
        $admin = Admin::findOrFail($request->admin_id);
        if ($admin
            && Hash::check(sprintf('%s%s', $admin->id, $admin->email), $token)
            && now()->lessThan($admin->email_verified_at->addDays(1))
        ) {
            return view('auth.admin.change-password', [
                'adminId' => $admin->id
            ]);
        }

        return redirect()->route('admin.login');
    }

    public function updatePassword(ResetPasswordRequest $request, $adminId)
    {
        $admin = Admin::findOrFail($adminId);

        if ($admin) {
            $admin->password = Hash::make($request->new_password);
            $admin->save();
        }

        $notification = [
            'message' => 'Cập nhật mật khẩu thành công',
            'alert-type' => 'success'
        ];

     
        return redirect()->route('admin.login')->with($notification);
    }
}
