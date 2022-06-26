@extends('layouts.guest')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>/
                    <li class='active'>Kết quả tìm kiếm với từ khóa "{{ request('search') }}"</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row'>
                @if (!empty($products))
                    <div class='col-md-12' style="margin: 30px 0 50px;">
                        <h3 class="result-search">
                            Có {{ count($products) }} kết quả tìm kiếm phù hợp
                        </h3>
                        <div class="clearfix filters-container m-t-10">
                            <div class="row">
                                <div class="col-4 col-sm-6 col-md-2">
                                    <div class="filter-tabs">
                                        <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                            <li class="active"> <a data-toggle="tab" href="#grid-container"><i
                                                        class="icon fa fa-th-large"></i>Grid</a> </li>
                                            <li><a data-toggle="tab" href="#list-container"><i
                                                        class="icon fa fa-th-list"></i>List</a></li>
                                        </ul>
                                    </div>
                                    <!-- /.filter-tabs -->
                                </div>
                                <!-- /.col -->
                                <div class="col col-sm-12 col-md-6">
                                    <div class="col col-sm-3 col-md-6 no-padding">
                                        <div class="lbl-cnt"> <span class="lbl">Sắp xếp</span>
                                            <div class="fld inline">
                                                <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                                    <button data-toggle="dropdown" type="button"
                                                        class="btn dropdown-toggle">Tùy chọn<span class="caret"></span>
                                                    </button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        <li role="presentation">
                                                            <a
                                                                href="{{ route(
                                                                    'search.view',
                                                                    array_merge(request()->query(), [
                                                                        'sort' => 0,
                                                                    ]),
                                                                ) }}">Giá:
                                                                tăng dần</a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a
                                                                href="{{ route(
                                                                    'search.view',
                                                                    array_merge(request()->query(), [
                                                                        'sort' => 1,
                                                                    ]),
                                                                ) }}">Giá:
                                                                giảm dần</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- /.fld -->
                                        </div>
                                        <!-- /.lbl-cnt -->
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="search-result-container ">
                            <div id="myTabContent" class="tab-content category-list">
                                <div class="tab-pane active " id="grid-container">
                                    <div class="category-product">
                                        <div class="row">
                                            @foreach ($products as $product)
                                                <div class="col col-sm-3 col-md-4 col-lg-3 wow">
                                                    <div class="products">
                                                        <div class="product">
                                                            <div class="product-image">
                                                                <div class="image"> <a
                                                                        href="{{ route('product.detail', ['product_id' => $product->id, 'slug' => $product->product_slug]) }}"><img
                                                                            height="249px;"
                                                                            src="{{ asset($product->image) }}"
                                                                            alt=""></a>
                                                                </div>
                                                                <!-- /.image -->
                                                                @if ($product->sale_price)
                                                                    <div class="tag new"><span>new</span></div>
                                                                @endif
                                                            </div>
                                                            <!-- /.product-image -->

                                                            <div class="product-info text-left">
                                                                <h3 class="name"><a
                                                                        href="{{ route('product.detail', ['product_id' => $product->id, 'slug' => $product->product_slug]) }}">{{ $product->name }}</a>
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
                                                                            <a href="{{ route('product.detail', ['product_id' => $product->id, 'slug' => $product->product_slug]) }}"
                                                                                data-toggle="tooltip"
                                                                                class="btn btn-primary icon" type="button">
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
                                            @endforeach
                                            <!-- /.item -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.category-product -->

                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane " id="list-container">
                                    <div class="category-product">
                                        @foreach ($products as $product)
                                            <div class="category-product-inner wow">
                                                <div class="products">
                                                    <div class="product-list product">
                                                        <div class="row product-list-row">
                                                            <div class="col col-sm-4 col-lg-4">
                                                                <div class="product-image">
                                                                    <div class="image"> <img height="249px;"
                                                                            src="{{ asset($product->image) }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>
                                                                <!-- /.product-image -->
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col col-sm-8 col-lg-8">
                                                                <div class="product-info">
                                                                    <h3 class="name"><a
                                                                            href="{{ route('product.detail', ['product_id' => $product->id, 'slug' => $product->product_slug]) }}">{{ $product->name }}</a>
                                                                    </h3>
                                                                    <div class="rating rateit-small"></div>
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
                                                                    <div class="description m-t-10">
                                                                        {{ $product->description }}</div>
                                                                    <div class="cart clearfix animate-effect">
                                                                        <div class="action">
                                                                            <ul class="list-unstyled">
                                                                                <li class="add-cart-button btn-group">
                                                                                    <a href="{{ route('product.detail', ['product_id' => $product->id, 'slug' => $product->product_slug]) }}"
                                                                                        data-toggle="tooltip"
                                                                                        class="btn btn-primary icon"
                                                                                        type="button"> <i
                                                                                            class="fa fa-shopping-cart"></i>
                                                                                        Tùy chọn</a>
                                                                                </li>
                                                                                <li class="lnk"> <a
                                                                                        data-toggle="tooltip"
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
                                                                <!-- /.product-info -->
                                                            </div>
                                                            <!-- /.col -->
                                                        </div>
                                                        <!-- /.product-list-row -->
                                                        <div class="tag new"><span>new</span></div>
                                                    </div>
                                                    <!-- /.product-list -->
                                                </div>
                                                <!-- /.products -->
                                            </div>
                                            <!-- /.category-product-inner -->
                                        @endforeach
                                    </div>
                                    <!-- /.category-product -->
                                </div>
                                <!-- /.tab-pane #list-container -->
                            </div>
                            <!-- /.tab-content -->
                            <div class="clearfix filters-container">
                                <div class="text-right">
                                    <div class="pagination-container">
                                        <ul class="list-inline list-unstyled">
                                            <li class="prev"><a
                                                    href="{{ route(
                                                        'search.view',
                                                        array_merge(request()->query(), [
                                                            'page' => $currentPage == 1 ? $currentPage : $currentPage - 1,
                                                        ]),
                                                    ) }}">
                                                    <i class="fa fa-angle-left"></i></a></li>
                                            @for ($i = 1; $i <= $lastPage; $i++)
                                                <li class="{{ $i == $currentPage ? 'active' : '' }}"><a
                                                        href="{{ route(
                                                            'search.view',
                                                            array_merge(request()->query(), [
                                                                'page' => $i,
                                                            ]),
                                                        ) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li class="next"><a
                                                    href="{{ route(
                                                        'search.view',
                                                        array_merge(request()->query(), [
                                                            'page' => $currentPage == $lastPage ? $lastPage : $currentPage + 1,
                                                        ]),
                                                    ) }} "><i
                                                        class="fa fa-angle-right"></i></a></li>
                                        </ul>
                                        <!-- /.list-inline -->
                                    </div>
                                    <!-- /.pagination-container -->
                                </div>
                                <!-- /.text-right -->

                            </div>
                            <!-- /.filters-container -->

                        </div>
                        <!-- /.search-result-container -->

                    </div>
                @else
                @endif
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.body-content -->
    @endsection
