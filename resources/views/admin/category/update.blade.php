@extends('layouts.admin', ['titlePage' => 'Cập nhật thông tin danh mục sản phẩm'])

@section('content')
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="box-title">Cập nhật danh mục sản phẩm</h3>
                                <a href="{{ route('all.categories') }}" type="button" class="btn btn-rounded btn-primary mb-5">Quay lại</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('category.update', ['category_id' => $category->id]) }}">
                                    @csrf
                                    <div class="form-group mb-20">
                                        <h5>Tên<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group mb-20">
                                        <h5>Slug <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="slug" class="form-control" value="{{ $category->slug }}">
                                            @error('slug')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
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
