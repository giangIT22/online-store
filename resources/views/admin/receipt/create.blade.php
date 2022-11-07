@extends('layouts.admin', ['titlePage' => 'Lập phiếu nhập kho'])
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content col-md-12" style="margin: 0">
            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="d-flex justify-content-between">
                        <h3 class="box-title">Lập phiếu nhập kho</h3>
                        <a href="{{ route('all.coupons') }}" type="button" class="btn btn-rounded btn-primary mb-5">Quay
                            lại</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('coupon.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="form-group mb-30">
                                                    <h5>Mã phiếu nhập kho<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="receipt_code" class="form-control"
                                                            value="{{ old('receipt_code') }}">
                                                        @error('receipt_code')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group mb-30">
                                                    <h5>Ghi chú<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="notes" id="" cols="30" rows="10" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 2nd row  -->
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-30">
                                            <h5>Nhà cung cấp<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select class="form-control" id="" name="">
                                                    <option value="">Chọn nhà cung câp</option>
                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                    @endforeach
                                                </select>
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
                                                        <th class="receipt-action">Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="choose-option">
                                                    <tr id="option-row-1">
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <select class="form-control" id="list-product"
                                                                        name="products[]">
                                                                        <option value="">Chọn sản phẩm</option>
                                                                        @foreach ($products as $product)
                                                                            <option value="{{ $product->id }}">
                                                                                {{ $product->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <select class="form-control" id="list-color"
                                                                        name="colors[]">
                                                                        <option value="">Chọn màu sắc</option>
                                                                        @foreach ($colors as $color)
                                                                            <option value="{{ $color->id }}">
                                                                                {{ $color->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <select class="form-control" id="list-size"
                                                                        name="sizes[]">
                                                                        <option value="">Chọn kích thước</option>
                                                                        @foreach ($sizes as $size)
                                                                            <option value="{{ $size->id }}">
                                                                                {{ $size->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <input type="text" name="import_amounts[]" id="import_amount_1"
                                                                        oninput="getAmount(event)"
                                                                        class="form-control" placeholder="Nhập số lượng">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <input type="text" name="import_prices[]" placeholder="Giá nhập" id="import_price_1"
                                                                        class="form-control" oninput="getPrice(event)"
                                                                        >
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <input type="text" disabled id="sum_price_1"
                                                                        class="form-control sum_price">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                            <a href="#" class="remove-first">
                                                                <i class="fa fa-trash"></i></a>
                                                        </td> --}}
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <input type="hidden" name="sum_price" class="final_price">
                                        <div class="row justify-content-end align-items-center mr-10 mt-30">
                                            <h4 class="final_price">Tổng tiền: </h4>
                                            <button type="button" class="btn btn-success add-option"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                Thêm sản phẩm</button>
                                        </div>
                                    </div>
                            </form>

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
