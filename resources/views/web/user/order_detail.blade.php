@extends('layouts.guest')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>/
                    <li><a href="{{ route('user.orders') }}">Tài khoản</a>
                    </li>/
                    <li class='active'>Đơn hàng {{ request('order_code') }}</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row order-detail'>
                <h1 class="title">Đơn hàng</h1>
                <p class="order-date">Ngày tạo : {{ $order->created_at->toDateTimeString() }}</p>
                @if ($order->status == 5)
                    <p class="order-date">Hủy lúc : {{ $order->created_at->toDateTimeString() }}</p>
                @endif

                <div class="info-customer">
                    <h3>Địa chỉ thanh toán</h3>
                    <p>
                        Trạng thái vận chuyển:
                        @if ($order->status == 0)
                            <b class="status_cancelled text-danger">Đơn hàng đang chờ xác nhận</b>
                        @elseif ($order->status == 1)
                            <b class="status_cancelled text-danger">Đơn hàng đã được xác nhận</b>
                        @elseif ($order->status == 2)
                            <b class="status_cancelled text-danger">Đơn hàng đang được giao</b>
                        @elseif ($order->status == 3)
                            <b class="status_cancelled text-danger">Đơn hàng đã giao thành công</b>
                        @elseif ($order->status == 4)
                            <b class="status_cancelled text-danger">Đơn hàng đang yêu cầu hủy/b>
                            @elseif ($order->status == 5)
                                <b class="status_cancelled text-danger">Đơn hàng đã hủy</b>
                        @endif
                    </p>
                    <p>
                        Trạng thái thanh toán:
                        @if ($order->status == 5)
                            <b class="status_cancelled text-danger">Đơn hàng đã hủy</b>
                        @elseif ($order->payment_status == 0)
                            <b class="status_cancelled text-danger">Chưa thanh toán</b>
                        @elseif($order->payment_status == 1)
                            <b class="status_cancelled text-danger">Đơn hàng đã thanh toán</b>
                        @endif

                    </p>
                    <div class="address">
                        <p><i class="fa fa-user"></i>{{ $order->name }}</p>
                        <p><i class="fa fa-map-marker"></i>

                            {{ $order->province . ', ' . $order->district . ', Việt Nam' }}
                        </p>
                        <p><i class="fa fa-phone"> </i>{{ $order->phone }}</p>

                    </div>
                </div>
                <table class="order-item">
                    <thead>
                        <tr>
                            <th colspan="4">Sản phẩm</th>
                            <th>Mã sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sumPrice = 0;
                            
                            foreach ($orderItem as $item) {
                                $sumPrice += $item->product_price * $item->amount;
                            }
                            
                            $priceDiscount = ($sumPrice * $couponDiscount) / 100;
                        @endphp

                        @foreach ($orderItem as $item)
                            <tr>
                                <th colspan="4">{{ $item->name }}</th>
                                <td>{{ $item->product_code }}</td>
                                <td>{{ number_format($item->product_price) }} vnd</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ number_format($item->product_price * $item->amount) }} vnd</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <table class="order-item">
                    <tbody>
                        <tr>
                            <th>Giảm giá ({{ $couponDiscount }} %):</th>
                            <td>{{ $priceDiscount == 0 ? 0 : '-' . number_format($priceDiscount) . ' vnd' }}</td>
                        </tr>
                        <tr>
                            <th>Phí vận chuyển:</th>
                            <td>{{ number_format($order->fee_charge) }} vnd</td>
                        </tr>
                        <tr>
                            <th>Tổng tiền:</th>
                            <th>{{ number_format($order->sum_price) }} vnd</th>
                        </tr>
                    </tbody>
                </table>

                @if ($order->status != 5 && $order->status != 2 && $order->status != 3)
                    <form action="{{ route('user.order.cancel', ['order_code' => $order->order_code]) }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="label"> Lý do hủy đơn hàng :</label>
                            <textarea name="reason_cancel" class="form-control" cols="30" rows="05"></textarea>
                        </div>

                        <button type="submit" class="btn btn-danger">Gửi</button>

                    </form>
                @endif

            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection
