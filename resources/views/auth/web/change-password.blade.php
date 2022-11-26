@extends('layouts.guest', ['titlePage' => 'Thay đổi mật khẩu'])

@section('content')

    <div class="body-content">
        <div class="container">
            <div class="sign-in-page" style="margin: 60px 0 120px;">
                <div class="row">
                    <!-- create a new account -->
                    <div class="col-md-18 col-sm-6 create-new-account">
                        <h4 class="checkout-subtitle">Thay đổi mật khẩu</h4>
                        <form class="register-form outer-top-xs" role="form" method="post" action="{{route('password.user-update', ['user_id' => $userId])}}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" >Mật khẩu mới<span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input" name="new_password">
                                @error('new_password')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" >Xác nhận mật khẩu<span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input" name="confirm_password">
                                @error('confirm_password')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary ">Đổi mật khẩu</button>
                            <a href="{{route('user.login')}}" class="btn" style="display:inline-block; color:rgb(54, 144, 228)">Hủy</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
