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
                    <form action="{{ route('checkout.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="info-customer col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-3">Thông tin nhận hàng</h4>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Họ và tên</label>
                                            <input type="text" class="form-control" name="full_name">
                                        </div>
                                        <div class="form-group">
                                            <label>Số diện thoại</label>
                                            <input type="text" class="form-control" name="phone_number">
                                        </div>
                                        <div class="form-group">
                                            <label>Địa chỉ</label>
                                            <input type="text" class="form-control" name="address">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputState">Tình thành</label>
                                            <select id="inputState" class="form-control choose-province" name="province">
                                                <option selected>---</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputState">Quận huyện</label>
                                            <select id="inputState" class="form-control choose-district" name="district">
                                                <option selected>---</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputState">Phường xã</label>
                                            <select id="inputState" class="form-control choose-ward" name="ward">
                                                <option selected>---</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Ghi chú (tùy chọn)" rows="3" name="notes"></textarea>
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
                                                <input class="form-check-input" type="radio" value="card" name="pay_method"
                                                    id="pay-card">
                                                <label class="form-check-label" for="pay-card">
                                                    Thanh toán qua PayPal
                                                </label>
                                                <img src="{{ asset('frontend/assets/images/payments/1.png')}}" alt="" style="margin-left: 20px;">
                                            </div>
                                            <div class="form-check pay-item">
                                                <input class="form-check-input" type="radio" value="cod" name="pay_method"
                                                    id="pay-transport">
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
                                    <span class="badge badge-secondary badge-pill">{{ $products->sum('amount') }}</span>
                                </h4>
                                <ul class="list-group mb-3">
                                    @php
                                        $sum = 0;
                                        foreach ($products as $product) {
                                            $sum += $product->amount * $product->price;
                                        }
                                    @endphp
                                    @foreach ($products as $product)
                                        <li class="list-group-item fix-flex lh-condensed">
                                            <div>
                                                <div class="info-cart-item">
                                                    <img src="{{ asset($product->image) }} " width="50px" alt="">
                                                    <span class="my-0 item-cart">{{ $product->name }}</span>
                                                </div>
                                                <small class="text-muted">Số lượng: {{ $product->amount }}</small>
                                            </div>
                                            <span
                                                class="text-muted item-price">{{ number_format($product->amount * $product->price) }}
                                                vnd</span>
                                        </li>
                                    @endforeach
                                    <li class="list-group-item bg-light">
                                        <div class="text-success fix-flex">
                                            <h6 class="my-0">Mã giảm giá</h6>
                                            <span>-40000</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item bg-light">
                                        <div class="text-success fix-flex">
                                            <h6 class="my-0">Phí vận chuyển</h6>
                                            <span>{{ number_format(40000) }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item fix-flex">
                                        <span>Tổng cộng</span>
                                        <strong>{{ number_format($sum) }} vnd</strong>
                                    </li>
                                </ul>


                                <div class="coupon-price">
                                    <input type="text" class="form-control input-coupon" placeholder="Nhập mã giảm giá">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary apply-coupon">Áp dụng</button>
                                    </div>
                                </div>

                                <div class="order-product">
                                    <a href="{{ route('cart.view') }}" class="col-md-8" style="padding: 0">
                                        < Quay về trang chủ</a>
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
