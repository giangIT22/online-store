<div class="col-sm-3 col-md-2"><br>
    <img class="card-img-top" style="border-radius: 50%"
        src="{{ $user->profile_photo_path ? asset($user->profile_photo_path) : asset('frontend/assets/images/no-image.jpg')}}"
        height="100%" width="100%"><br><br>

    <ul class="list-group list-group-flush">
        <a href="{{ route('user.home') }}" class="{{ Route::current()->uri == 'user' ? 'active ' : ''}}btn btn-primary btn-sm btn-block">Trang chủ</a>
        <a href="{{ route('user.profile') }}" class="{{ Route::current()->uri == 'user/profile' ? 'active ' : ''}}btn btn-primary btn-sm btn-block">Thông tin người dùng</a>

        <a href="{{ route('user.change.password') }}" class="{{ Route::current()->uri == 'user/change/password' ? 'active ' : ''}}btn btn-primary btn-sm btn-block">Thay đổi mật khẩu</a>

        <a href="{{ route('user.orders') }}" class="{{ Route::current()->uri == 'user/orders' ? 'active ' : ''}} btn btn-primary btn-sm btn-block">Đơn hàng</a>

        {{-- <a href="{{ route('return.order.list') }}" class="btn btn-primary btn-sm btn-block">Return Orders</a>

        <a href="{{ route('cancel.orders') }}" class="btn btn-primary btn-sm btn-block">Cancel Orders</a> --}}

        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Đăng xuất</a>

    </ul>

</div> <!-- // end col md 2 -->
