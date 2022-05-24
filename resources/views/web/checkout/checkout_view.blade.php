@extends('layouts.guest')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>/
                    <li class='active'>Thanh toán</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <form>
                        <div class="row">
                            <div class="info-customer col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-3">Thông tin nhận hàng</h4>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Họ và tên</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Số diện thoại</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Địa chỉ</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputState">Tình thành</label>
                                            <select id="inputState" class="form-control">
                                                <option selected>---</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputState">Quận huyện</label>
                                            <select id="inputState" class="form-control">
                                                <option selected>---</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputState">Phường xã</label>
                                            <select id="inputState" class="form-control">
                                                <option selected>---</option>
                                            </select>
                                        </div>
                                        <div class="form-group">                                            
                                            <textarea class="form-control" placeholder="Ghi chú (tùy chọn)" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-3">Thanh toán</h4>
                                        <div class="transport">
                                            <div class="alert alert-info" role="alert">
                                                Vui lóng nhập thông tin giao hàng
                                            </div>
                                        </div>
                                        <div class="payment">
                                            <div class="form-check pay-item">
                                                <input class="form-check-input" type="radio" value="" name="pay" id="pay-card">
                                                <label class="form-check-label" for="pay-card">
                                                  Thanh toán qua VNPAY
                                                </label>
                                              </div>
                                              <div class="form-check pay-item">
                                                <input class="form-check-input" type="radio" value="" name="pay" id="pay-transport">
                                                <label class="form-check-label" for="pay-transport">
                                                  Thanh toán khi giao hàng
                                                </label>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="info-product col-md-4">
                                <h4 class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Đơn hàng</span>
                                    <span class="badge badge-secondary badge-pill">3</span>
                                </h4>
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Product name</h6>
                                            <small class="text-muted">Brief description</small>
                                        </div>
                                        <span class="text-muted">$12</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between bg-light">
                                        <div class="text-success">
                                            <h6 class="my-0">Promo code</h6>
                                            <small>EXAMPLECODE</small>
                                        </div>
                                        <span class="text-success">-$5</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Total (USD)</span>
                                        <strong>$20</strong>
                                    </li>
                                </ul>


                                <div class="coupon-price">
                                    <input type="text" class="form-control input-coupon" placeholder="Nhập mã giảm giá">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Áp dụng</button>
                                    </div>
                                </div>
                                
                                <div class="order-product">
                                    <a href="{{ route('cart.view') }}" class="col-md-8" style="padding: 0">< Quay về trang chủ</a>
                                    <button class="btn btn-primary btn-lg" type="submit">Đặt hàng</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
