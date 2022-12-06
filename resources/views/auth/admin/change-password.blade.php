<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thay đổi mật khẩu</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/admin.css') }}">
</head>

<body>
    <div class="login gradient-custom fix-flex">
        <div class="container">
            <div class="row fix-flex">
                <form class="bg-dark text-white" action="{{ route('password.admin-update', ['admin_id' => $adminId]) }}" method="post">
                    @csrf
                    <h3>Thay đổi mật khẩu</h3>
                    <div class="form-group">
                        <label class="info-title" >Mật khẩu mới</label>
                        <input type="password" class="form-control unicase-form-control text-input" name="new_password">
                        @error('new_password')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title" >Xác nhận mật khẩu</label>
                        <input type="password" class="form-control unicase-form-control text-input" name="confirm_password">
                        @error('confirm_password')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn-forget-password">Đổi mật khẩu</button>
                    {{-- <p>Bạn chưa có tài khoản? <a href="{{ route('admin.register') }}">Đăng ký</a> </p> --}}
                </form>
            </div>
        </div>
    </div>
</body>

</html>
