@extends('layouts.guest')
@section('content')
    <div class="body-content" style="margin: 50px 0 100px;">
        <div class="container">
            <div class="row">

                @include('web.user.sidebar')

                <div class="col-md-10">
                    <table class="table list-order">
                        <thead>
                            <tr>
                                <th>Đơn hàng</th>
                                <th>Ngày</th>
                                <th>Địa chỉ</th>
                                <th>Giá trị đơn hàng</th>
                                <th>Tình trạng thanh toán</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th><a
                                            href="{{ route('user.order_detail', ['order_code' => $order->order_code]) }}">{{ $order->order_code }}</a>
                                    </th>
                                    <td>{{ $order->created_at->toDateString() }}</td>
                                    <td>{{ $order->province . ', ' . $order->district }}</td>
                                    <td>{{ number_format($order->sum_price) }} vnd</td>
                                    <td>
                                        @if ($order->status == 5)
                                            Đơn hàng đã hủy
                                        @elseif ($order->payment_status == 0)
                                            Chưa thanh toán
                                        @elseif($order->payment_status == 1)
                                            Đã thanh toán
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->status == 0)
                                            Đơn hàng đang chờ xác nhận
                                        @elseif ($order->status == 1)
                                            Đơn hàng đã được xác nhận
                                        @elseif ($order->status == 2)
                                            Đơn hàng đang được giao
                                        @elseif ($order->status == 3)
                                            Giao thành công
                                        @elseif ($order->status == 4)
                                            Đơn hàng đang yêu cầu hủy
                                        @elseif ($order->status == 5)
                                            Đơn hàng đã hủy
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div> <!-- // end col md 6 -->

            </div> <!-- // end row -->

        </div>

    </div>
@endsection
