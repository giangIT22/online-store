@extends('layouts.admin', ['titlePage' => 'Thêm nhân viên'])
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Thêm nhân viên</h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('employee.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-8">

                                                <div class="form-group">
                                                    <h5>Tên<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name" class="form-control">
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
                                                        <input type="text" name="email" class="form-control">
                                                        @error('title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">

                                                <div class="form-group">
                                                    <h5>Mật khẩu <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="password" name="password" class="form-control">
                                                        @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <h5>Xác nhận mật khẩu<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="password" name="password_confirmation"
                                                            class="form-control">
                                                        @error('password_confirmation')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label>Chọn vai trò</label>
                                                    <select class="form-control select2 select2-hidden-accessible"
                                                        multiple="" style="width: 100%;" data-placeholder="Chọn vai trò">
                                                        
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="text-xs-right">
                                            <button type="submit" class="btn btn-rounded btn-primary mb-5">Thêm</button>
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

@push('scrypt')
    <script src="{{ asset('../assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script>
        $('.select2').select2();
    </script>
@endpush
