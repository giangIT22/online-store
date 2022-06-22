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
                        <a href="{{ route('all.products') }}" type="button" class="btn btn-rounded btn-primary mb-5">Quay lại</a>
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
                                                        <select name="category_id" class="form-control"
                                                            id="list-category">
                                                            <option value="">Select Category
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->name }}</option>
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
                                                        <input type="text" name="name" class="form-control">
                                                        @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Mô tả<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="description" class="form-control">
                                                        @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Slug<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_slug" class="form-control">
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
                                                        <input type="text" name="product_code" class="form-control">
                                                        @error('product_code')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 3RD row  -->
                                        
                                        {{-- 
                                        <div class="row">
                                            <div class="col-md-8">

                                                <div class="form-group">
                                                    <h5>Product Amount <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_qty" class="form-control">
                                                        @error('product_qty')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                        </div> --}}

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <h5>Giá<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_price" class="form-control">
                                                        @error('product_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Giá sale<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="sale_price" class="form-control">
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
                                                        <input type="file" name="image" class="form-control" id="image">
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5>Tags<span class="text-danger">*</span></h5>
                                                <select placeholder="Thêm tags" multiple data-role="tagsinput" name="tags[]"
                                                    style="display: none;"></select>
                                            </div>
                                        </div>

                                        <div class="row mt-20">
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_2" name="hot_deals"
                                                                value="1">
                                                            <label for="checkbox_2">Hot Deals</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_3" name="featured"
                                                                value="1">
                                                            <label for="checkbox_3">Featured</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_4" name="special_offer"
                                                                value="1">
                                                            <label for="checkbox_4">Special Offer</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_5" name="special_deals"
                                                                value="1">
                                                            <label for="checkbox_5">Special Deals</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
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

                                        <hr>

                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Thêm">
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
