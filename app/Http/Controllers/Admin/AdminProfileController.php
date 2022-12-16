<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdatePasswordRequest;
use App\Http\Requests\AdminUpdateProfileRequest;
use App\Models\Admin;
use App\Models\User;
use App\Traits\StoreImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    use StoreImageTrait;

    public function adminProfile()
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->id());

        return view('admin.profile.admin_profile', compact('admin'));
    }

    public function adminProfileEdit()
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->id());

        return view('admin.profile.profile_edit', compact('admin'));
    }

    public function adminProfileStore(AdminUpdateProfileRequest $request)
    {
        $data = request()->all();
        $admin = Admin::findOrFail(Auth::guard('admin')->id());

        if (isset($data['profile_photo_path'])) {
            $adminImage = $this->uploadImage($request, 'profile_photo_path', 'admin');
            $data['profile_photo_path'] = $adminImage['file_path'];
        } else {
            $data['profile_photo_path'] = $admin->profile_photo_path;
        }

        $admin->update($data);

        $notification = array(
			'message' => 'Thông tin người dùng đã được cập nhật thành công',
			'alert-type' => 'success'
		);

		return redirect()->route('admin.profile')->with($notification);
    }

    public function adminChangePassword()
    {
        return view('admin.profile.change_password');
    }

    public function adminUpdatePassword(AdminUpdatePasswordRequest $request)
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->id());
        $input = $request->all();

        $admin->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        $notification = array(
			'message' => 'Thay đổi mật khẩu thành công',
			'alert-type' => 'success'
		);

		return redirect()->route('admin.profile')->with($notification);
    }

    public function allUsers()
    {
        $data = User::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.user.index', [
            'listUsers' => $data->items(),
            'total' => $data->total(),
            'lastPage' => $data->lastPage(),
            'role' => Auth::user()->role_id
        ]);
    }

    public function deleteUser($userId)
    {
        try {
            User::findOrFail($userId)->delete();
            return response()->json([
                'code' => 200,
                'status' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 200,
                'status' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function search(Request $request)
    {
        try {
            if ($request->search_key) {
                $data = $this->searchUser($request->search_key);
                return response()->json($data);
            } else {
                $data = User::orderBy('created_at', 'desc')->paginate(10);
                $data = [
                    'listUsers' => $data->items(),
                    'total' => $data->total(),
                    'lastPage' => $data->lastPage(),
                    'role' => Auth::user()->role_id
                ];
                return response()->json($data);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function searchUser($params)
    {
        $dataSearch = User::search($params)->paginate(User::PER_PAGE);

        return [
            'listUsers' => $dataSearch->items(),
            'lastPage' => $dataSearch->lastPage()
        ];
    }
}
