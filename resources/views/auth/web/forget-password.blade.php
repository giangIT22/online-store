@extends('layouts.guest', ['titlePage' => 'Quên mật khẩu'])

@section('content')
    <div class="body-content">
        <div class="container">
            <div class="sign-in-page" style="margin: 100px 0 200px;">
                <div class="row">
                    <!-- create a new account -->
                    <div class="col-md-18 col-sm-6 create-new-account">
                        <h4 class="checkout-subtitle">Tìm tài khoản của bạn</h4>
                        <p class="text title-tag-line">Vui lòng nhập email để tìm kiếm tài khoản của bạn.</p>
                        <form class="register-form outer-top-xs" method="post" action="{{route('password.email')}}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title">Email<span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" name="email">
                                @error('email')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary ">Tìm kiếm</button>
                            <a href="{{route('index')}}" class="btn" style="display:inline-block; color:rgb(54, 144, 228)">Hủy</a>
                        </form>

                    </div>
                    <!-- create a new account -->
                </div>
            </div>
        </div>
    </div>
@endsection
