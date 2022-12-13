@extends('layouts.admin', ['titlePage' => 'Chi tiết phiếu nhập kho'])
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content col-md-12" style="margin: 0">
            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="d-flex justify-content-between">
                        <h3 class="box-title">Chi tiết phiếu nhập kho</h3>
                        <a href="{{ route('all.receipts') }}" type="button" class="btn btn-rounded btn-primary mb-5">Quay
                            lại</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-30">
                                                <h5>Ghi chú<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea disabled name="notes" id="" cols="30" rows="10" class="form-control">{{ $notes }}</textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- end 2nd row  -->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-30">
                                        <h5>Nhà cung cấp<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" class="form-control" value="{{ $companyName }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    {{-- =================Dữ liệu nhập hàng ==== --}}
                                    <h3 class="receipt-data-title">Dữ liệu nhập hàng</h3>
                                    <div class="row">
                                        <table class="table-receipt">
                                            <thead>
                                                <tr>
                                                    <th class="w-350">Sản phẩm</th>
                                                    <th class="w-250">Màu sắc</th>
                                                    <th class="w-250">Kích thước</th>
                                                    <th class="w-180">Số lượng</th>
                                                    <th>Giá nhập</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody class="choose-option">
                                                @foreach ($data as $item)
                                                    <tr id="option-row-1">
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $item->product_name }}" disabled>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $item->product_color }}" disabled>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $item->product_size }}" disabled>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $item->import_amount }}" disabled>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <input type="text" class="form-control"
                                                                        value="{{ number_format($item->import_price, 0, '', '.') }}"
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <input type="text" disabled
                                                                        value="{{ number_format($item->import_amount * $item->import_price, 0, '', '.') }}"
                                                                        class="form-control sum_price">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="sum_price" class="final_sum_price">
                                    <div class="row justify-content-end align-items-center mr-10 mt-30">
                                        <h4 class="final_price">Tổng tiền: {{ number_format($item->sum_price, 0, '', '.') }}
                                            VND</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
