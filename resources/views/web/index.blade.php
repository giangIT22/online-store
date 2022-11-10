@extends('layouts.guest')

@php
    $minDate = \Carbon\Carbon::now()->subDays(15);
@endphp

@section('content')
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="row">
                <!-- ============================================== SIDEBAR ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                    <!-- ================================== TOP NAVIGATION ================================== -->
                    @include('partitions.web.sidebar', ['categories' => $categories])
                    <!-- /.side-menu -->
                    <!-- ================================== TOP NAVIGATION : END ================================== -->

                    <!-- ============================================== HOT DEALS: END ============================================== -->

                    <!-- ============================================== SPECIAL OFFER ============================================== -->

                    {{-- <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                        <h3 class="section-title">Special Offer</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                                <div class="item">
                                    @foreach ($specialOfferProducts as $product)
                                        <div class="products special-product">
                                            <div class="product">
                                                <div class="product-micro">
                                                    <div class="row product-micro-row">
                                                        <div class="col col-xs-5">
                                                            <div class="product-image">
                                                                <div class="image">
                                                                    <a
                                                                        href="{{ route('product.detail', ['product_id' => $product->id]) }}">
                                                                        <img src="{{ asset($product->image) }}"
                                                                            alt="" style="height: ">
                                                                    </a>
                                                                </div>
                                                                <!-- /.image -->

                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col col-xs-7">
                                                            <div class="product-info">
                                                                <h3 class="name fix-lh"><a
                                                                        href="{{ route('product.detail', ['product_id' => $product->id]) }}">{{ $product->name }}</a>
                                                                </h3>
                                                                @include('partitions.web.rating', [
                                                                    'productId' => $product->id,
                                                                ])
                                                                <div class="product-price">
                                                                    @if ($product->sale_price)
                                                                        <span class="price">
                                                                            {{ number_format($product->sale_price) }}
                                                                            đ</span>
                                                                        <span
                                                                            class="price-before-discount">{{ number_format($product->product_price) }}
                                                                            đ</span>
                                                                    @else
                                                                        <span
                                                                            class="price">{{ number_format($product->product_price) }}
                                                                            đ</span>
                                                                    @endIf
                                                                </div>
                                                                <!-- /.product-price -->

                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.product-micro-row -->
                                                </div>
                                                <!-- /.product-micro -->

                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div> --}}
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== SPECIAL OFFER : END ============================================== -->
                    <!-- ============================================== PRODUCT TAGS ============================================== -->
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== PRODUCT TAGS : END ============================================== -->
                    {{-- <!-- ============================================== NEWSLETTER ============================================== -->
                    <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
                        <h4 class="section-title" style="font-size: 13px">ĐĂNG KÝ NHẬN TIN KHUYẾN MÃI
                        </h4>
                        <div class="sidebar-widget-body outer-top-xs">
                            <form>
                                <div class="form-group">
                                    <label class="sr-only">Email address</label>
                                    <input type="email" class="form-control" placeholder="Nhập địa chỉ email của bạn">
                                </div>
                                <button class="btn btn-primary">Đăng ký</button>
                            </form>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div> --}}
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">

                    <div id="hero">
                        <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                            @foreach ($banners as $banner)
                                <div class="item" style="background-image: url({{ asset($banner->image) }});">
                                    <div class="container-fluid">
                                        <div class="caption bg-color vertical-center text-left">
                                            <div class="big-text fadeInDown-1"> {{ $banner->title }} </div>
                                            <div class="excerpt fadeInDown-2 hidden-xs">
                                                <span>{{ $banner->description }}</span>
                                            </div>
                                            <div class="button-holder fadeInDown-3"> <a
                                                    href="{{ route('category.all.products') }}"
                                                    class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop
                                                    Now</a>
                                            </div>
                                        </div>
                                        <!-- /.caption -->
                                    </div>
                                    <!-- /.container-fluid -->
                                </div>
                            @endforeach
                            <!-- /.item -->
                        </div>
                        <!-- /.owl-carousel -->
                    </div>

                    <!-- ========================================= SECTION – HERO : END ========================================= -->

                    <!-- ============================================== INFO BOXES ============================================== -->
                    <div class="info-boxes wow fadeInUp">
                        <div class="info-boxes-inner">
                            <div class="row">
                                <div class="col-md-6 col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">money back</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">30 Days Money Back Guarantee</h6>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="hidden-md col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">free shipping</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">Shipping on orders over $99</h6>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-md-6 col-sm-4 col-lg-4">
                                    <div class="info-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h4 class="info-box-heading green">Special Sale</h4>
                                            </div>
                                        </div>
                                        <h6 class="text">Extra $5 off on all items </h6>
                                    </div>
                                </div>
                                <!-- .col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.info-boxes-inner -->

                    </div>
                    <!-- /.info-boxes -->
                    <!-- ============================================== INFO BOXES : END ============================================== -->
                    <!-- ============================================== SCROLL TABS ============================================== -->
                    <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                        <div class="more-info-tab clearfix ">
                            <h3 class="new-product-title pull-left">Sản phẩm mới</h3>
                            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                                <li class="active"><a data-transition-type="backSlide" href="#all"
                                        data-toggle="tab">All</a></li>
                                @foreach ($categories as $category)
                                    <li><a data-transition-type="backSlide" href="#category{{ $category->id }}"
                                            data-toggle="tab">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                            <!-- /.nav-tabs -->
                        </div>
                        <div class="tab-content outer-top-xs">

                            <div class="tab-pane in active" id="all">
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                        @foreach ($products as $product)
                                            <div class="item item-carousel">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a
                                                                    href="{{ route('product.detail', ['product_id' => $product->id]) }}">
                                                                    <img style="max-height:189px;"
                                                                        src="{{ asset($product->image) }}" alt="">
                                                                </a>
                                                            </div>
                                                            <!-- /.image -->

                                                            @if ($product->created_at > $minDate && $product->created_at <= now())
                                                                <div class="tag new"><span>new</span></div>
                                                            @endif
                                                        </div>
                                                        <!-- /.product-image -->

                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a
                                                                    href="{{ route('product.detail', ['product_id' => $product->id]) }}">{{ $product->name }}</a>
                                                            </h3>
                                                            @include('partitions.web.rating', [
                                                                'productId' => $product->id,
                                                            ])
                                                            <div class="description"></div>
                                                            <div class="product-price">
                                                                @if ($product->sale_price)
                                                                    <span class="price">
                                                                        {{ number_format($product->sale_price) }}
                                                                        đ</span>
                                                                    <span
                                                                        class="price-before-discount">{{ number_format($product->product_price) }}
                                                                        đ</span>
                                                                @else
                                                                    <span
                                                                        class="price">{{ number_format($product->product_price) }}
                                                                        đ</span>
                                                                @endIf
                                                            </div>
                                                        </div>
                                                        <!-- /.product-info -->
                                                        <div class="cart clearfix animate-effect fix-style">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <li class="add-cart-button btn-group">
                                                                        <a href="{{ route('product.detail', ['product_id' => $product->id]) }}"
                                                                            data-toggle="tooltip"
                                                                            class="btn btn-primary icon" type="button">
                                                                            <i class="fa fa-shopping-cart"></i> Tùy
                                                                            chọn</a>
                                                                        <button class="btn btn-primary cart-btn"
                                                                            type="button">Add to cart</button>
                                                                    </li>
                                                                    <li class="lnk"> <a data-toggle="tooltip"
                                                                            class="add-to-cart preview-product"
                                                                            id="{{ $product->id }}"> <i class="fa fa-eye"
                                                                                aria-hidden="true"></i>
                                                                        </a> </li>
                                                                </ul>
                                                            </div>
                                                            <!-- /.action -->
                                                        </div>
                                                        <!-- /.cart -->
                                                    </div>
                                                    <!-- /.product -->

                                                </div>
                                                <!-- /.products -->
                                            </div>
                                            <!-- /.item -->
                                        @endforeach
                                    </div>
                                    <!-- /.home-owl-carousel -->
                                </div>
                                <!-- /.product-slider -->
                            </div>
                            <!-- /.tab-pane -->

                            @foreach ($categories as $category)
                                @php
                                    $productOfCategory = DB::table('products')
                                        ->where('category_id', $category->id)
                                        ->orderBy('id', 'DESC')
                                        ->limit(6)
                                        ->get();
                                @endphp
                                <div class="tab-pane" id="category{{ $category->id }}">
                                    <div class="product-slider">
                                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme"
                                            data-item="4">
                                            @forelse ($productOfCategory as $product)
                                                <div class="item item-carousel">
                                                    <div class="products">
                                                        <div class="product">
                                                            <div class="product-image">
                                                                <div class="image"> <a
                                                                        href="{{ route('product.detail', ['product_id' => $product->id]) }}">
                                                                        <img style="max-height:189px;"
                                                                            src="{{ asset($product->image) }}"
                                                                            alt=""></a>
                                                                </div>
                                                                <!-- /.image -->

                                                                @if ($product->created_at > $minDate && $product->created_at <= now())
                                                                    <div class="tag new"><span>new</span></div>
                                                                @endif
                                                            </div>
                                                            <!-- /.product-image -->

                                                            <div class="product-info text-left">
                                                                <h3 class="name"><a
                                                                        href=" {{ route('product.detail', ['product_id' => $product->id]) }}">{{ $product->name }}</a>
                                                                </h3>
                                                                <div class="rating rateit-small"></div>
                                                                <div class="description"></div>
                                                                <div class="product-price">
                                                                    @if ($product->sale_price)
                                                                        <span class="price">
                                                                            {{ number_format($product->sale_price) }}
                                                                            đ</span>
                                                                        <span
                                                                            class="price-before-discount">{{ number_format($product->product_price) }}
                                                                            đ</span>
                                                                    @else
                                                                        <span
                                                                            class="price">{{ number_format($product->product_price) }}
                                                                            đ</span>
                                                                    @endIf
                                                                </div>
                                                            </div>
                                                            <!-- /.product-info -->
                                                            <div class="cart clearfix animate-effect">
                                                                <div class="action">
                                                                    <ul class="list-unstyled">
                                                                        <li class="add-cart-button btn-group">
                                                                            <a href="{{ route('product.detail', ['product_id' => $product->id]) }}"
                                                                                data-toggle="tooltip"
                                                                                class="btn btn-primary icon"
                                                                                type="button">
                                                                                <i class="fa fa-shopping-cart"></i> Tùy
                                                                                chọn</a>
                                                                            <button class="btn btn-primary cart-btn"
                                                                                type="button">Add to cart</button>
                                                                        </li>
                                                                        <li class="lnk"> <a data-toggle="tooltip"
                                                                                class="add-to-cart preview-product"
                                                                                id="{{ $product->id }}"> <i
                                                                                    class="fa fa-eye"
                                                                                    aria-hidden="true"></i>
                                                                            </a> </li>
                                                                    </ul>
                                                                </div>
                                                                <!-- /.action -->
                                                            </div>
                                                            <!-- /.cart -->
                                                        </div>
                                                        <!-- /.product -->

                                                    </div>
                                                    <!-- /.products -->
                                                </div>
                                                <!-- /.item -->
                                            @empty
                                                <h5 class="text-danger">Không có sản phẩm nào</h5>
                                            @endforelse
                                        </div>
                                        <!-- /.home-owl-carousel -->
                                    </div>
                                    <!-- /.product-slider -->
                                </div>
                            @endforeach

                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.scroll-tabs -->
                    <!-- ============================================== SCROLL TABS : END ============================================== -->

                    <!-- ============================================== BEST SELLER ============================================== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">Sản phẩm bán chạy</h3>
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                            {{-- @foreach ($bestSellProducts as $product)
                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image"> <a
                                                        href="{{ route('product.detail', ['product_id' => $product->product_id]) }}"><img
                                                            style="max-height: 189px;" src="{{ asset($product->image) }}"
                                                            alt=""></a> </div>
                                                <!-- /.image -->

                                                @if (!empty($product->sale_price))
                                                    <div class="tag sale"><span>sale</span></div>
                                                @endif
                                            </div>
                                            <!-- /.product-image -->

                                            <div class="product-info text-left">
                                                <h3 class="name"><a
                                                        href="{{ route('product.detail', ['product_id' => $product->product_id]) }}">
                                                        {{ $product->name }}</a>
                                                </h3>
                                                @include('partitions.web.rating', [
                                                    'productId' => $product->product_id,
                                                ])
                                                <div class="description"></div>
                                                @if (!$product->sale_price)
                                                    <div class="product-price"> <span class="price">
                                                            {{ number_format($product->product_price) }}đ </span>
                                                    @else
                                                        <div class="product-price"> <span class="price">
                                                                {{ number_format($product->sale_price) }}đ </span>
                                                            <span
                                                                class="price-before-discount">${{ $product->product_price }}đ</span>
                                                @endif
                                            </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect fix-style">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <a href="{{ route('product.detail', ['product_id' => $product->product_id]) }}"
                                                            data-toggle="tooltip" class="btn btn-primary icon"
                                                            type="button" data-original-title="" title=""> <i
                                                                class="fa fa-shopping-cart"></i> Tùy
                                                            chọn</a>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to
                                                            cart</button>
                                                    </li>
                                                    <li class="lnk"> <a data-toggle="tooltip"
                                                            class="add-to-cart preview-product" id="11"
                                                            data-original-title="" title=""> <i class="fa fa-eye"
                                                                aria-hidden="true"></i>
                                                        </a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->
                                </div>
                                <!-- /.products -->
                        </div>
                        @endforeach --}}
                        <!-- /.item -->
                    </section>
                    <!-- ============================================== BEST SELLER :END ============================================== -->

                    <!-- ============================================== PRODUCTS BY CATEGORY ============================================== -->
                    @foreach ($productByCategory as $category)
                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">{{ $category->name }}</h3>
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                                @foreach ($category->products as $product)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a
                                                            href="{{ route('product.detail', ['product_id' => $product->id]) }}"><img
                                                                style="max-height: 189px;"
                                                                src="{{ asset($product->image) }}" alt=""></a>
                                                    </div>
                                                    <!-- /.image -->

                                                    @if (!empty($product->sale_price))
                                                        <div class="tag sale"><span>sale</span></div>
                                                    @endif
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="{{ route('product.detail', ['product_id' => $product->id]) }}">
                                                            {{ $product->name }}</a>
                                                    </h3>
                                                    @include('partitions.web.rating', [
                                                        'productId' => $product->product_id,
                                                    ])
                                                    <div class="description"></div>
                                                    @if (!$product->sale_price)
                                                        <div class="product-price"> <span class="price">
                                                                {{ number_format($product->product_price) }}đ </span>
                                                        @else
                                                            <div class="product-price"> <span class="price">
                                                                    {{ number_format($product->sale_price) }}đ </span>
                                                                <span
                                                                    class="price-before-discount">${{ $product->product_price }}đ</span>
                                                    @endif
                                                </div>
                                                <!-- /.product-price -->

                                            </div>
                                            <!-- /.product-info -->
                                            <div class="cart clearfix animate-effect fix-style">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <a href="{{ route('product.detail', ['product_id' => $product->id]) }}"
                                                                data-toggle="tooltip" class="btn btn-primary icon"
                                                                type="button" data-original-title="" title=""> <i
                                                                    class="fa fa-shopping-cart"></i> Tùy
                                                                chọn</a>
                                                            <button class="btn btn-primary cart-btn" type="button">Add to
                                                                cart</button>
                                                        </li>
                                                        <li class="lnk"> <a data-toggle="tooltip"
                                                                class="add-to-cart preview-product" id="11"
                                                                data-original-title="" title=""> <i
                                                                    class="fa fa-eye" aria-hidden="true"></i>
                                                            </a> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- /.cart -->
                                        </div>
                                        <!-- /.product -->
                                    </div>
                                    <!-- /.products -->
                            </div>
                    @endforeach
                    <!-- /.item -->
                    </section>
                    @endforeach

                    <!-- ============================================== PRODUCTS BY CATEGORY :END ============================================== -->

                    <!-- ============================================== BLOG SLIDER ============================================== -->
                    <section class="section latest-blog outer-bottom-vs wow fadeInUp">
                        <h3 class="section-title">Tin tức mới nhất</h3>
                        <div class="blog-slider-container outer-top-xs">
                            <div class="owl-carousel blog-slider custom-carousel">
                                @foreach ($blogs as $blog)
                                    <div class="item">
                                        <div class="blog-post">
                                            <div class="blog-post-image">
                                                <div class="image"> <a
                                                        href="{{ route('blog.detail', ['blog_title' => $blog->slug]) }}"><img
                                                            src="{{ asset($blog->post_image) }}" alt=""></a>
                                                </div>
                                            </div>
                                            <!-- /.blog-post-image -->

                                            <div class="blog-post-info text-left">
                                                <h3 class="name"><a
                                                        href="{{ route('blog.detail', ['blog_title' => $blog->slug]) }}">{{ $blog->title }}</a>
                                                </h3>
                                                <span class="info">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    {{ $blog->created_at->toDateTimeString() }}
                                                </span>
                                                <p class="text">{{ $blog->content }}</p>
                                                <a href="{{ route('blog.detail', ['blog_title' => $blog->slug]) }}"
                                                    class="lnk btn btn-primary">Read more</a>
                                            </div>
                                            <!-- /.blog-post-info -->

                                        </div>
                                        <!-- /.blog-post -->
                                    </div>
                                    <!-- /.item -->
                                @endforeach
                            </div>
                            <!-- /.owl-carousel -->
                        </div>
                        <!-- /.blog-slider-container -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== BLOG SLIDER : END ============================================== -->
                </div>
                <!-- /.homebanner-holder -->
                <!-- ============================================== CONTENT : END ============================================== -->
            </div>
        </div>
        <!-- /.container -->
    </div>
@endsection
