@extends('layouts.guest', ['titlePage' => 'Dăng nhập'])

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>/
                    <li class='active'>Đăng nhập</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- Sign-in -->
                    <div class="col-md-8 col-sm-6 sign-in">
                        <h4 class="">ĐĂNG NHẬP TÀI KHOẢN</h4>
                        <p class="">Nếu bạn đã có tài khoản, đăng nhập tại đây.</p>
                        <form class="register-form outer-top-xs" role="form" method="post" action="{{route('login.store')}}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title">Email<span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" name="email">
                                @error('email')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title">Mật khẩu<span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input" name="password">
                                @error('password')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            {{-- <div class="radio outer-xs">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Remember
                                    me!
                                </label>
                                <a href="#" class="forgot-password pull-right">Forgot your Password?</a>
                            </div> --}}
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Đăng nhập</button>
                            <a href="{{route('user.register')}}" class="btn" style="display:inline-block; color:rgb(54, 144, 228)">Đăng ký</a>
                            <p>
                                <a href="{{route('password.request')}}" class="btn" style="display:inline-block; color:rgb(54, 144, 228)">Quên mật khẩu</a>
                            </p>
                        </form>
                    </div>
                    <!-- Sign-in -->
                </div>
            </div>
        </div>
    </div>
@endsection
