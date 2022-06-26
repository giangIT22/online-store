<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
</head>

<body>
    <div class="login gradient-custom fix-flex">
        <div class="container">
            <div class="row fix-flex">
                <form class="bg-dark text-white" action="{{ route('admin.login.store') }}" method="post">
                    @csrf
                    <h3>Đăng nhập</h3>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" placeholder="Nhập email ..." name="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mật khẩu</label>
                        <input type="password" class="form-control" placeholder="Nhập password" name="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <a href="" class="forget-password">Quên mật khẩu</a>
                    <button type="submit">Đăng nhập</button>
                    {{-- <p>Bạn chưa có tài khoản? <a href="{{ route('admin.register') }}">Đăng ký</a> </p> --}}
                </form>
            </div>
        </div>
    </div>
</body>

</html>
