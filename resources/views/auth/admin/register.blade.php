<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng ký</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
</head>

<body>
    <div class="login gradient-custom fix-flex">
        <div class="container">
            <div class="row fix-flex">
                <form class="bg-dark text-white"  action="{{ route('admin.register.store') }}" method="post">
                    @csrf

                    <h3>Đăng ký</h3>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="text" class="form-control"
                            placeholder="Nhập email ..." name="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" class="form-control" placeholder="Nhập tên ..." name="user_name">
                        @error('user_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mật khẩu</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit">Đăng ký</button>
                    <p>Bạn đã có tài khoản? <a href="{{ route('admin.login') }}">Đăng nhập</a> </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
