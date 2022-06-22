@extends('layouts.admin', ['titlePage' => 'Thêm bài viết'])
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="d-flex justify-content-between">
                        <h3 class="box-title">Thêm bài viết</h3>
                        <a href="{{ route('all.blogs') }}" type="button" class="btn btn-rounded btn-primary mb-5">Quay lại</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('blog.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-8">

                                                <div class="form-group">
                                                    <h5>Tên bài viết<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="title" class="form-control">
                                                        @error('title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Slug<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="slug" class="form-control">
                                                        @error('slug')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>Nội dung<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="content" class="form-control" cols="30" rows="4"></textarea>
                                                        @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 2nd row  -->
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <h5>ẢNh bài viết<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="post_image" class="form-control"
                                                            id="image">
                                                        @error('post_image')
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
    <script src="{{ asset('../assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script>
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
