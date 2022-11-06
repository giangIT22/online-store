@extends('layouts.admin', ['titlePage' => 'Cập nhật cung cấp'])

@section('content')
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="box-title">Cập nhật thông tin nhà cung cấp</h3>
                                <a href="{{ route('all.companies') }}" type="button" class="btn btn-rounded btn-primary mb-5">Quay lại</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body d-flex justify-content-center">
                            <div class="col-md-6">
                                <form method="post" action="{{ route('company.update', ['company_id' => $company->id]) }}">
                                    @csrf
                                    <div class="form-group">
                                        <h5>Tên nhà cung cấp<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Email<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="email" class="form-control" value="{{ old('email', $company->email) }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Số điện thoại<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $company->phone) }}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Địa chỉ<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="address" class="form-control" value="{{ old('address', $company->address) }}">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Cập nhật">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    </div>

@endsection
