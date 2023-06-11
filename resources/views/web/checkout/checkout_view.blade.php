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
            <div class="row checkout-form">
                <div class="col-md-12 ">
                    <form action="{{ route('checkout.store') }}" method="post" class="save-order">
                        @csrf
                        <div class="row">
                            <div class="info-customer col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-3">Thông tin nhận hàng</h4>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email"
                                                value="{{ Auth::user()->email }}" readonly>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Họ và tên</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name', Auth::user()->name) }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Số diện thoại</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ old('phone', Auth::user()->phone) }}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Địa chỉ</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ old('address', Auth::user()->address) }}">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="inputState">Tỉnh thành</label>
                                            <input type="hidden" name="province" id="province_name">
                                            <select id="inputState" class="form-control choose-province">
                                                {{-- @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                @endforeach --}}
                                            </select>
                                            @error('province')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="inputState">Quận huyện</label>
                                            <input type="hidden" name="district" id="district_name">
                                            <select id="inputState" class="form-control choose-district">

                                            </select>
                                            @error('district')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="inputState">Phường xã</label>
                                            <input type="hidden" name="ward" id="ward_name">
                                            <select id="inputState" class="form-control choose-ward">

                                            </select>
                                            @error('ward')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Ghi chú (tùy chọn)" rows="3" name="notes"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-3">Phí giao hàng</h4>
                                        <div class="transport">
                                            {{-- <div class="alert alert-info" role="alert">
                                                Vui lóng nhập thông tin giao hàng
                                            </div> --}}
                                        </div>
                                        <h4 class="mb-3">Thanh toán</h4>
                                        @error('payment_type')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="payment">
                                            <div class="form-check pay-item">
                                                <input class="form-check-input" type="radio" value="Visa"
                                                    name="payment_type" id="pay-card">
                                                <label class="form-check-label" for="pay-card">
                                                    Thanh toán qua VNPAY
                                                </label>
                                                <img src="{{ asset('frontend/assets/images/payments/1.png') }}"
                                                    alt="" style="margin-left: 20px;">
                                            </div>
                                            <div class="form-check pay-item">
                                                <input class="form-check-input" type="radio" value="COD"
                                                    name="payment_type" id="pay-transport">
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
                                            $sum += $product->amount * $product->product_price;
                                        }
                                    @endphp
                                    @foreach ($products as $product)
                                        <li class="list-group-item fix-flex lh-condensed pd-10">
                                            <div>
                                                <div class="info-cart-item fix-flex">
                                                    <img src="{{ asset($product->image) }} " width="50px"
                                                        style="margin-right: 10px;" alt="">
                                                    <div class="product-info-detail">
                                                        <span class="my-0 item-cart">{{ $product->name }}</span>
                                                        <span class="size-item-cart">{{ $product->size_name }} </span>
                                                    </div>
                                                </div>
                                                <small class="text-muted amount-text">Số lượng: {{ $product->amount }}</small>
                                            </div>
                                            <span
                                                class="text-muted item-price">{{ number_format($product->amount * $product->product_price) }}</span>
                                        </li>
                                    @endforeach
                                    <li class="list-group-item bg-light fee-shipping">
                                        <div class="text-success fix-flex">
                                            <h6 class="my-0 charge-text">Phí vận chuyển</h6>
                                            <span class="fee_charge_item">0</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item fix-flex">
                                        <span class="sum-text">Tổng cộng</span>
                                        <input type="hidden" value="{{ $sum }}" name="sum_price" class="hidden_sum_price">
                                        <strong class="sum_price_item">{{ number_format($sum) }} vnd</strong>
                                    </li>
                                </ul>


                                <div class="coupon-price">
                                    <div>
                                        <input type="text" class="form-control input-coupon" name="coupon_code"
                                            placeholder="Nhập mã giảm giá">
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary apply-coupon">Áp dụng</button>
                                    </div>
                                </div>

                                <div class="order-product">
                                    <a href="{{ route('cart.view') }}" style="padding: 0">
                                        < Quay về trang chủ</a>
                                            <button class="btn btn-primary btn-lg submit-order" type="submit">Đặt hàng</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/remove_coupon.js') }}"></script>
@endpush
