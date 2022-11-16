@extends('layouts.admin', ['titlePage' => 'Thêm sản phẩm'])
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="d-flex justify-content-between">
                        <h3 class="box-title">Thêm sản phẩm</h3>
                        <a href="{{ route('all.products') }}" type="button" class="btn btn-rounded btn-primary mb-5">Quay
                            lại</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Chọn danh mục<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="category_id" class="form-control" id="list-category">
                                                            <option value="">Select Category
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                @if (old('category_id') == $category->id)
                                                                    <option value="{{ $category->id }}" selected>
                                                                        {{ $category->name }}</option>
                                                                @else
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Chọn danh mục con<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subcategory_id" class="form-control" id="list-sub">


                                                        </select>
                                                        @error('subcategory_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 1st row  -->



                                        <div class="row">
                                            <div class="col-md-8">

                                                <div class="form-group">
                                                    <h5>Tên sản phẩm<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ old('name') }}">
                                                        @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Mô tả<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="description" class="form-control" cols="30" rows="10">{{ old('description') }}</textarea>
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 2nd row  -->

                                        {{-- <div class="row">
                                            <!-- start 3RD row  -->
                                            <div class="col-md-8">

                                                <div class="form-group">
                                                    <h5>Mã sản phẩm<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_code" class="form-control"
                                                            value="{{ old('product_code') }}">
                                                        @error('product_code')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 3RD row  --> --}}

                                        {{-- <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <h5>Giá bán<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_price" class="form-control"
                                                            value="{{ old('product_price') }}">
                                                        @error('product_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 5th row  --> --}}

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <h5>Ảnh sản phẩm<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="image" class="form-control"
                                                            id="image">
                                                        @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div id="preview_img">
                                                    <img width="150px" id="showImage" src="" alt=""
                                                        style="margin-bottom:10px;">
                                                </div>
                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 6th row  -->

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <h5>Ảnh chi tiết<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="image_path[]" class="form-control"
                                                            multiple>
                                                        @error('image_path')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- CHOOSE option --}}
                                        {{-- <div class="row choose-option" style="margin-top: 30px;">
                                            <div class="row col-md-9 option-item" id="row-1">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Màu sắc <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select class="form-control" id="list-color" name="colors[]">
                                                                <option value="">Chọn màu sắc</option>
                                                                @foreach ($colors as $color)
                                                                    <option value="{{ $color->id }}" id="color-{{$color->id}}">
                                                                        {{ $color->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Kích thước <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select class="form-control" id="list-size" name="sizes[]">
                                                                <option value="">Chọn kích thước</option>
                                                                @foreach ($sizes as $size)
                                                                    <option value="{{ $size->id }}" id="size-{{$size->id}}">
                                                                        {{ $size->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="add-option">
                                                    <span><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <hr>

                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                                value="Thêm">
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
    <script src="{{ asset('../assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('../assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script>
        document.querySelector('#list-category').onchange = function() {
            $.ajax({
                url: `/admin/category/sub/` + this.value,
                success: function(response) {
                    let newArr = response.subCategories.map(function(item) {
                        return `<option value="${item.id}">${item.sub_category_name}</option>`;
                    });

                    document.querySelector('#list-sub').innerHTML = newArr.join(' ');
                }
            });
        };

        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endpush
