@extends('layouts.admin', ['titlePage' => 'edit product'])
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Product </h4>

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
                                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="category_id" class="form-control"
                                                            id="list-category">
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
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
                                                    <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subcategory_id" class="form-control" id="list-sub">
                                                            @foreach ($subcategories as $subCategory)
                                                                <option value="{{ $subCategory->id }}"
                                                                    {{ $subCategory->id == $product->subCategory_id ? 'selected' : '' }}>
                                                                    {{ $subCategory->sub_category_name }}
                                                                </option>
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
                                                    <h5>Product Name<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $product->name }}">
                                                        @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Description<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="description" class="form-control"
                                                            value="{{ $product->description }}">
                                                        @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 2nd row  -->

                                        <div class="row">
                                            <!-- start 3RD row  -->
                                            <div class="col-md-8">

                                                <div class="form-group">
                                                    <h5>Product Code <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_code" class="form-control"
                                                            value="{{ $product->product_code }}">
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
                                                    <h5>Product Amount <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_qty" class="form-control"
                                                            value="{{ $product->product_qty }}">
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
                                                    <h5>Product Price <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_price" class="form-control"
                                                            value="{{ $product->product_price }}">
                                                        @error('product_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Product Sell Price <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="sell_price" class="form-control">
                                                        @error('sell_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 5th row  -->
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <h5>Product Image <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="image" class="form-control" id="image" value="{{ $product->image }}">
                                                        @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div id="preview_img">
                                                    <img width="150px" id="showImage" src="{{ asset($product->image) }}"
                                                        alt="" style="margin-bottom:10px;">
                                                </div>
                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 6th row  -->

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <h5>Detail Image<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="image_path[]" class="form-control"
                                                            multiple>
                                                    </div>
                                                </div>
                                                <div id="multile_img">
                                                    <div class="col-md-12" style="padding: 0 !important;">
                                                        @foreach ($product->images as $image)
                                                            <img width="150px"
                                                                src="{{ asset($image->image_path) }}" alt=""
                                                                style="margin: 0 10px 10px 0;">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5>Tags Product <span class="text-danger">*</span></h5>
                                                <select placeholder="add tags" multiple data-role="tagsinput" name="tags[]"
                                                    style="display: none;">
                                                    @foreach ($product->productTags as $tag)
                                                        <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
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
