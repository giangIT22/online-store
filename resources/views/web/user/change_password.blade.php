@extends('layouts.guest')
@section('content')
    <div class="body-content" style="margin: 50px 0 100px;">
        <div class="container">
            <div class="row">

                @include('web.user.sidebar')

                <div class="col-md-2">

                </div> <!-- // end col md 2 -->


                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">Thay đổi mật khẩu</span><strong> </strong>
                        </h3>

                        <div class="card-body">

                            <form method="post" action="{{ route('user.password.update') }}">
                                @csrf

                                <div class="form-group">
                                    <label class="info-title">Mật khẩu hiện tại<span>
                                        </span></label>
                                    <input type="password" id="current_password" name="oldpassword" class="form-control">
                                    @error('oldpassword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title">Mật khẩu mới<span>
                                        </span></label>
                                    <input type="password" id="password" name="password" class="form-control">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label class="info-title">Xác nhận mật khẩu<span>
                                        </span></label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Cập nhật</button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div> <!-- // end col md 6 -->

            </div> <!-- // end row -->

        </div>

    </div>
@endsection
