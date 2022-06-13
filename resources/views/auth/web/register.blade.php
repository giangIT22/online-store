@extends('layouts.guest', ['titlePage' => 'Dăng ký'])

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('index')}}">Trang chủ</a></li>/
                    <li class='active'>Đăng ký</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- create a new account -->
                    <div class="col-md-18 col-sm-6 create-new-account">
                        <h4 class="checkout-subtitle">Đăng ký tài khoản</h4>
                        <p class="text title-tag-line">Nếu chưa có tài khoản vui lòng đăng ký tại đây</p>
                        <form class="register-form outer-top-xs" role="form" method="post" action="{{route('register.store')}}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title">Email<span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" name="email">
                                @error('email')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title">Tên <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" name="user_name">
                                @error('user_name')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" >Mật khẩu <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input" name="password">
                                @error('password')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary ">Đăng ký</button>
                            <a href="{{route('user.login')}}" class="btn" style="display:inline-block; color:rgb(54, 144, 228)">Đăng nhập</a>
                        </form>

                    </div>
                    <!-- create a new account -->
                </div>
            </div>
        </div>
    </div>
@endsection
