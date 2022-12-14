<?php

namespace App\Services;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminService implements AdminServiceInterface
{
    public function getEmployees()
    {
        $data = Admin::with('role')->orderBy('id', 'desc')->paginate(Admin::PER_PAGE);
        
        return [
            'listEmployees' => $data->items(),
            'total' => $data->total(),
            'lastPage' => $data->lastPage(),
            'role' => Auth::user()->role_id
        ];
    }

    public function searchEmployee($params)
    {
        $dataSearch = Admin::search($params)->query(function ($builder) {
            $builder->with('role');
        })->paginate(Admin::PER_PAGE);
        return [
            'listEmployees' => $dataSearch->items(),
            'lastPage' => $dataSearch->lastPage()
        ];
    }

    public function makeDataVerifyMail(string $email)
    {
        $admin = Admin::where('email', $email)->first();
        if (!$admin) {
            return false;
        }
        $admin->update([
            'email_verified_at' => Carbon::now(),
        ]);        

        $token = Hash::make(sprintf('%s%s', $admin->id, $email));

        return [
            'email' => $email,
            'name' => $admin->name,
            'link' => route('admin-password.reset', [
                'token' => $token,
                'admin_id' => $admin->id,
            ]),
        ];
    }
}
