<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdatePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Services\OrderServiceInterface;
use App\Services\UserServiceInterface;
use App\Traits\StoreImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use StoreImageTrait;

    protected $userServie, $orderService;

    public function __construct(UserServiceInterface $userServie, OrderServiceInterface $orderService)
    {
        $this->userServie = $userServie;
        $this->orderService = $orderService;
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

    public function getListOrder()
    {
        $categories = Category::with('subCategories')->get();
        $user = User::findOrFail(Auth::id());
        $orders = $this->orderService->getOrdersOfUser(Auth::id());

        return view('web.user.orders', compact('categories', 'user', 'orders'));
    }

    public function getOrderDetail($orderCode)
    {
        $categories = Category::with('subCategories')->get();
        list($order, $orderItem, $couponDiscount) = $this->orderService->getOrderDetail($orderCode);
        
        return view('web.user.order_detail', compact('categories', 'order', 'orderItem', 'couponDiscount'));
    }

    public function cancelOrder($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->first();
        
        $order->update([
            'reason_cancel' => request()->reason_cancel,
            'status' => Order::REQUEST_CANCEL            
        ]);

        $notification = [
            'message' => 'Yêu cầu hủy đơn hàng đã được gửi đi',
            'alert-type' => 'success'
        ];

        return redirect()->route('user.order_detail', ['order_code' => $order->order_code])->with($notification);
    }
}
