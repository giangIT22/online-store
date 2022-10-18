<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function makeDataVerifyMail(string $email)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            return false;
        }
        $user->update([
            'email_verified_at' => Carbon::now(),
        ]);        

        $token = Hash::make(sprintf('%s%s', $user->id, $email));

        return [
            'email' => $email,
            'name' => $user->name,
            'link' => route('password.reset', [
                'token' => $token,
                'user_id' => $user->id,
            ]),
        ];
    }
}
