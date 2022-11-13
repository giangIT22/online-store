@extends('layouts.admin', ['titlePage' => 'Cập nhật nhân viên'])
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="d-flex justify-content-between">
                        <h3 class="box-title">Cập nhật nhân viên</h3>
                        <a href="{{ route('all.employees') }}" type="button" class="btn btn-rounded btn-primary mb-5">Quay
                            lại</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('employee.update', ['employee_id' => $employee->id]) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-8">

                                                <div class="form-group">
                                                    <h5>Tên<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ old('name', $employee->name) }}">
                                                        @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">

                                                <div class="form-group">
                                                    <h5>Email<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="email" class="form-control"
                                                            value="{{ old('email', $employee->email) }}">
                                                        @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">

                                                <div class="form-group">
                                                    <h5>Số điện thoại<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="phone" class="form-control"
                                                            value="{{ old('phone', $employee->phone) }}">
                                                        @error('phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">

                                                <div class="form-group">
                                                    <h5>Số căn cước<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="cccd" class="form-control"
                                                            value="{{ old('cccd', $employee->cccd) }}">
                                                        @error('cccd')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">

                                                <div class="form-group">
                                                    <h5>Địa chỉ<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="address" class="form-control"
                                                            value="{{ old('address', $employee->address) }}">
                                                        @error('address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Trạng thái<span class="text-danger">*</span></h5>
                                                    @foreach ($statues as $key => $item)
                                                        <input name="status" type="radio" id="radio_{{$key}}" value="{{$key}}" class="radio-col-primary" {{ $employee->status == $key ? 'checked' : ''}}>
                                                        <label class="status-employee" for="radio_{{$key}}">{{ $item }}</label>
                                                    @endforeach
                                                </div>

                                                <div class="form-group mb-20">
                                                    <h5>Lựa chọn vai trò<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="role_id" id="select" class="form-control">
                                                            <option value="">Vai trò</option>
                                                            @foreach ($roles as $role)
                                                                @if (old('role_id', $employee->role->id) == $role->id)
                                                                    <option value="{{ $role->id }}" selected>
                                                                        {{ $role->name }}</option>
                                                                @else
                                                                    <option value="{{ $role->id }}">
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('role_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="text-xs-right">
                                            <button type="submit" class="btn btn-rounded btn-primary mb-5">Cập nhật</button>
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
