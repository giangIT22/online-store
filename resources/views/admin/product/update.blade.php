@extends('layouts.admin', ['titlePage' => 'Cập nhật thông tin sản phẩm'])
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="d-flex justify-content-between">
                        <h4 class="box-title">Cập nhật thông tin sản phẩm</h4>
                        <a href="{{ route('all.products') }}" type="button" class="btn btn-rounded btn-primary mb-5">Quay
                            lại</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('product.update', ['product_id' => $product->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Chọn danh mục<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="category_id" class="form-control" id="list-category">
                                                            @foreach ($categories as $category)
                                                                @if (old('category_id', $product->category->id) == $category->id)
                                                                    <option value="{{ $category->id }}" selected>
                                                                        {{ $category->name }}</option>
                                                                @else
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->name }}
                                                                    </option>
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
                                                            @foreach ($subcategories as $subCategory)
                                                                @if (old('subcategory_id', $product->subcategory_id) == $subCategory->id)
                                                                    <option value="{{ $subCategory->id }}" selected>
                                                                        {{ $subCategory->sub_category_name }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $subCategory->id }}">
                                                                        {{ $subCategory->sub_category_name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach

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
                                                            value="{{ old('name', $product->name) }}">
                                                        @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Mô tả<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="description" class="form-control"
                                                            value="{{ old('description', $product->description) }}">
                                                        @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Slug<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_slug" class="form-control"
                                                            value="{{ old('product_slug', $product->product_slug) }}">
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 2nd row  -->

                                        <div class="row">
                                            <!-- start 3RD row  -->
                                            <div class="col-md-8">

                                                <div class="form-group">
                                                    <h5>Mã sản phẩm<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_code" class="form-control"
                                                            value="{{ old('product_code', $product->product_code) }}">
                                                        @error('product_code')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 3RD row  -->

                                        <div class="row">
                                            <div class="col-md-8">

                                                <div class="form-group">
                                                    <h5>Số lượng<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_qty" class="form-control"
                                                            value="{{ old('product_qty', $product->product_qty) }}" disabled>
                                                        @error('product_qty')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <h5>Giá<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_price" class="form-control"
                                                            value="{{ old('product_price', $product->product_price) }}">
                                                        @error('product_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Giá sale<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="sale_price" class="form-control"
                                                            value="{{ old('sale_price', $product->sale_price ?? '') }}">
                                                        @error('sale_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 5th row  -->
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <h5>Ảnh sản phẩm<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="image" class="form-control"
                                                            id="image" value="{{ $product->image }}">
                                                        @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div id="preview_img">
                                                    <img width="150px" id="showImage"
                                                        src="{{ asset($product->image) }}" alt=""
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
                                                    </div>
                                                </div>
                                                <div id="multile_img">
                                                    <div class="col-md-12" style="padding: 0 !important;">
                                                        @foreach ($product->images as $image)
                                                            <img width="150px" src="{{ asset($image->image_path) }}"
                                                                alt="" style="margin: 0 10px 10px 0;">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5>Tags<span class="text-danger">*</span></h5>
                                                <select placeholder="Thêm tags" multiple data-role="tagsinput"
                                                    name="tags[]" style="display: none;">
                                                    @foreach ($product->productTags as $tag)
                                                        <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- CHOOSE SIZE --}}
                                        <div class="row choose-size">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Kích thước <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select class="form-control" id="list-size">
                                                            <option value="">Chọn kích thước</option>
                                                            @foreach ($sizes as $size)
                                                                <option value="{{ $size->id }}">
                                                                    {{ $size->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach ($sizeInfos as $item)
                                            <div class="row">
                                                <div class="col-md-3">

                                                    <div class="form-group">
                                                        <input type="hidden" name="sizes[]" value="{{ $item->id }}"
                                                            class="size-item-{{ $item->id }}">
                                                        <h5>{{ $item->name }}<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="amounts[]" class="form-control"
                                                                placeholder="Vui lòng nhập số lượng sản phẩm"
                                                                value="{{ $item->amount }}">
                                                        </div>
                                                    </div>

                                                </div> <!-- end col md 4 -->
                                            </div>
                                        @endforeach

                                        <hr>

                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                                value="Cập nhật">
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
