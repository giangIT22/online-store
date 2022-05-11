@extends('layouts.guest')

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
                        <div class="social-sign-in outer-top-xs">
                            <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                            <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                        </div>
                        <form class="register-form outer-top-xs" role="form" method="post" action="{{route('login.store')}}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email<span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input"
                                    id="exampleInputEmail1" name="email">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">Mật khẩu<span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="exampleInputPassword1" name="password">
                            </div>
                            {{-- <div class="radio outer-xs">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Remember
                                    me!
                                </label>
                                <a href="#" class="forgot-password pull-right">Forgot your Password?</a>
                            </div> --}}
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Đăng nhập</button>
                        </form>
                    </div>
                    <!-- Sign-in -->
                </div>
            </div>
        </div>
    </div>
@endsection
