@extends('layouts.admin',['titlePage' => 'Chi tiết đơn hàng'])
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <div class="d-flex justify-content-between">
                        <h3 class="box-title">Chi tiết đơn hàng</h3>
                        <a href="/admin/orders/view" type="button" class="btn btn-rounded btn-primary mb-5">Quay lại</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="box box-bordered">

                                <table class="table">
                                    <tr>
                                        <th> Đơn hàng: </th>
                                        <th class="text-danger"> {{ $order->order_code }} </th>
                                    </tr>
                                    <tr>
                                        <th> Tên khách hàng: </th>
                                        <th> {{ $order->name }} </th>
                                    </tr>

                                    <tr>
                                        <th> Số điện thoại: </th>
                                        <th> {{ $order->phone }} </th>
                                    </tr>
                                    
                                    <tr>
                                        <th> Email: </th>
                                        <th> {{ $order->email }} </th>
                                    </tr>
                                    <tr>
                                        <th> Địa chỉ: </th>
                                        <th> {{ $order->province . ', ' . $order->district }} </th>
                                    </tr>
                                    <tr>
                                        <th> Phương thức thanh tóan: </th>
                                        <th> {{ $order->payment_type }} </th>
                                    </tr>
                                    <tr>
                                        <th> Phí giao hàng </th>
                                        <th> {{ number_format($order->fee_charge) }} vnd </th>
                                    </tr>
                                    <tr>
                                        <th> Giá trị đơn hàng: </th>
                                        <th> {{ number_format($order->sum_price) }} vnd </th>
                                    </tr>
                                    <tr>
                                        <th> Trạng thái: </th>
                                        <th>
                                            @if ($order->status == 0)
                                                <span class="badge badge-pill badge-danger">Chưa xác nhận</span>
                                            @elseif ($order->status == 1)
                                                <span class="badge badge-pill badge-primary">Đã xác nhận</span>
                                            @elseif ($order->status == 2)
                                                <span class="badge badge-pill badge-primary">Đang giao hàng</span>
                                            @elseif ($order->status == 3)
                                                <span class="badge badge-pill badge-primary">Đã giao hàng</span>
                                            @elseif ($order->status == 4)
                                                <span class="badge badge-pill badge-danger">Yêu cầu hủy đơn hàng</span>
                                            @elseif ($order->status == 5)
                                                <span class="badge badge-pill badge-danger">Đơn hàng đã bị hủy</span>
                                            @endif
                                        </th>
                                    </tr>
                                    @if ($order->status == 4)
                                        <tr>
                                            <th> Lý do hủy đơn hàng: </th>
                                            <th>
                                                <textarea rows="5" cols="5" class="form-control">{{ $order->reason_cancel }}</textarea>
                                            </th>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th> </th>
                                        <th>
                                            @if ($order->status == 0)
                                                <a href="{{ route('order.confirm', ['order_code' => $order->order_code]) }}"
                                                    class="btn btn-block btn-success" id="confirm">Xác nhận đơn hàng</a>
                                            @elseif($order->status == 1)
                                                <a href="{{ route('order.shipping', ['order_code' => $order->order_code]) }}"
                                                    class="btn btn-block btn-success" id="shipping">Thực hiện giao
                                                    hàng</a>
                                            @elseif($order->status == 2)
                                                <a href="{{ route('order.delivered', ['order_code' => $order->order_code]) }}"
                                                    class="btn btn-block btn-success" id="delivered">Xác nhận đã giao
                                                    hàng</a>
                                            @elseif($order->status == 4)
                                                <a href="{{ route('order.cancel', ['order_code' => $order->order_code]) }}"
                                                    class="btn btn-block btn-success" id="delivered">Xác nhận hủy đơn hàng</a>
                                            @endif

                                        </th>
                                    </tr>

                                </table>

                            </div>
                        </div>
                        @if ($order->status == 2)
                            <div class="col-md-3">
                                <a href="{{ route('order.cancel', ['order_code' => $order->order_code]) }}"
                                    class="btn btn-block btn-success" id="delivered">Xác nhận đơn hàng bị hoàn lại</a>
                            </div>
                        @endif
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="col-md-12 col-12">
                    <div class="box box-bordered">
                        <table class="table">
                            <tbody>

                                <tr>
                                    <td width="10%">
                                        <label for="">Ảnh sản phẩm </label>
                                    </td>

                                    <td width="20%">
                                        <label for="">Sản phẩm</label>
                                    </td>

                                    <td width="10%">
                                        <label for="">Mã sản phẩm </label>
                                    </td>


                                    <td width="10%">
                                        <label for=""> Giá </label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> Số lượng </label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> Tổng </label>
                                    </td>

                                </tr>


                                @foreach ($orderItem as $item)
                                    <tr>
                                        <td width="10%">
                                            <label for=""><img src="{{ asset($item->image) }}" height="50px;"
                                                    width="50px;"> </label>
                                        </td>

                                        <td width="20%">
                                            <label for=""> {{ $item->name . ' ' . '(' . $item->size_name . ' - ' . $item->color_name .')' }}</label>
                                        </td>


                                        <td width="10%">
                                            <label for=""> {{ $item->product_code }}</label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> {{ number_format($item->product_price) }} vnd</label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> {{ $item->amount }}</label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> {{ number_format($item->product_price * $item->amount) }}
                                                vnd</label>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div> <!--  // cod md -12 -->
            </div>
            <!-- /.box -->
        </section>
    </div>
@endsection
