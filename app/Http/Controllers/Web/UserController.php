<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdatePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Category;
use App\Models\User;
use App\Services\UserServiceInterface;
use App\Traits\StoreImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use StoreImageTrait;

    protected $userServie;

    public function __construct(UserServiceInterface $userServie)
    {
        $this->userServie = $userServie;
    }

    public function home()
    {
        $categories = Category::with('subCategories')->get();
        $user = User::findOrFail(Auth::id());

        return view('web.user.home', compact('categories', 'user'));
    }

    public function userProfile()
    {
        $categories = Category::with('subCategories')->get();
        $user = User::findOrFail(Auth::id());

        return view('web.user.user_profile', compact('categories', 'user'));
    }

    public function userProfileStore(UserUpdateRequest $request)
    {
        $data = request()->all();
        $user = User::find(Auth::id());

        if (isset($data['profile_photo_path'])) {
            $userImage = $this->uploadImage($request, 'profile_photo_path', 'user');
            $data['profile_photo_path'] = $userImage['file_path'];
        } else {
            $data['profile_photo_path'] = $user->profile_photo_path;
        }

        $user->update($data);

        $notification = array(
			'message' => 'Thông tin người dùng đã được cập nhật thành công',
			'alert-type' => 'success'
		);

		return redirect()->route('user.home')->with($notification);
    }

    public function userChangePassword()
    {
        $categories = Category::with('subCategories')->get();
        $user = User::findOrFail(Auth::id());

        return view('web.user.change_password', compact('categories', 'user'));
    }

    public function userPasswordUpdate(UserUpdatePasswordRequest $request)
    {
        $user = User::find(Auth::id());
        $input = $request->all();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        $notification = array(
			'message' => 'Thay đổi mật khẩu thành công',
			'alert-type' => 'success'
		);

		return redirect()->route('user.home')->with($notification);
    }
}
