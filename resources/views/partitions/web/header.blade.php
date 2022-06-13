<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="icon fa fa-heart"></i>Yêu thích</a></li>
                        <li><a href="{{route('cart.view')}}"><i class="icon fa fa-shopping-cart"></i>Giỏ hàng</a></li>
                        @if (Auth::check())
                            <li><a href="{{ route('user.home') }}"><i class="icon fa fa-user"></i>Tài khoản</a></li>
                        @else
                            <li><a href="{{ route('user.login') }}"><i class="icon fa fa-lock"></i>Đăng nhập</a></li>
                        @endif
                    </ul>
                </div>
                <!-- /.cnt-account -->

                <div class="cnt-block">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown"
                                data-toggle="dropdown"><span class="value">Ngôn ngữ
                                </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">English</a></li>
                                <li><a href="#">Vietnamese</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- /.list-unstyled -->
                </div>
                <!-- /.cnt-cart -->
                <div class="clearfix"></div>
            </div>
            <!-- /.header-top-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo"> <a href="{{ route('index') }}"> <img
                                src="{{ asset('frontend/assets/images/logo.png') }}" alt="logo">
                        </a> </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->
                </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form method="get" action="{{ route('search.view')}}">
                            <div class="control-group">
                                <input class="search-field" placeholder="Bạn đang tìm sản phẩm nào ..." name="search" />
                                <button class="search-button" href="#"></button>
                            </div>
                        </form>
                    </div>
                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="dropdown dropdown-cart">
                        <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i>
                                </div>
                                @php
                                    $sum = 0;
                                    $productsInCart = collect([]);
                                    $count = 0;
                                    if (Auth::check()) {
                                        $cart = DB::table('carts')
                                            ->where('user_id', Auth::id())
                                            ->first() ?? 0;
                                        if ($cart) {
                                            $products = DB::table('product_cart')->select('product_id', 'amount', 'price')
                                                            ->where('cart_id', $cart->id)->get();

                                            foreach ($products as $item) {
                                                $product = DB::table('products')->where('id', $item->product_id)->first();
                                                $productsInCart->push([
                                                    'product_image' => $product->image,
                                                    'product_name' => $product->name,
                                                    'product_price' => $item->price,
                                                    'amount' => $item->amount,
                                                ]);
                                                $count += $item->amount;
                                            }

                                            if ($productsInCart) {
                                                foreach ($productsInCart as $product) {
                                                    $sum += $product['amount'] * $product['product_price'];
                                                }   
                                            }
                                        } else {
                                            $productsInCart = 0;
                                        }
                                    }
                                @endphp
                                <div class="basket-item-count"><span
                                        class="count">{{ $count}}</span></div>
                                <div class="total-price-basket"> <span class="lbl">giỏ hàng -</span>
                                    <span class="total-price"><span
                                            class="value">{{ $sum ? number_format($sum, 0, '', '.') . ' vnd' : 0 }}</span></span>
                                </div>
                            </div>
                        </a>
                        @if (Auth::check() && !empty($productsInCart))
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="cart-item product-summary">
                                        @foreach ($productsInCart as $product)
                                            <div class="row" style="margin-bottom: 10px;">
                                                <div class="col-xs-4">
                                                    <div class="image"> <a href="#"><img
                                                                src="{{ asset($product['product_image']) }}" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-xs-7">
                                                    <h3 class="name"><a
                                                            href="#">{{ $product['product_name'] }}</a>
                                                    </h3>
                                                    <div class="price">
                                                        {{ number_format($product['product_price'], 0, '', '.') . ' vnd' }}
                                                    </div>
                                                </div>
                                                {{-- <div class="col-xs-1 action"> <a href="#"><i
                                                            class="fa fa-trash"></i></a>
                                                </div> --}}
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- /.cart-item -->
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="clearfix cart-total">
                                        <div class="pull-right"> <span class="text">Tổng tiền
                                                :</span><span
                                                class='price'>{{ $sum ? number_format($sum, 0, '', '.') . ' vnd' : 0 }}</span>
                                        </div>
                                        <div class="clearfix"></div>
                                        <a href="{{ route('checkout.create') }}" class="btn btn-upper btn-primary m-t-20 btn-block" style="font-size: 12px;">Tiến hành
                                            thanh toán</a>
                                        <a href="{{route('cart.view')}}" class="btn btn-upper btn-primary m-t-20 btn-block">Giỏ hàng</a>
                                    </div>
                                    <!-- /.cart-total-->

                                </li>
                            </ul>
                        @else
                            <div class="dropdown-menu not-product">
                                Không có sản phẩm nào trong giỏ hàng
                            </div>
                        @endif
                    </div>
                    <!-- /.dropdown-cart -->

                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                </div>
                <!-- /.top-cart-row -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                        class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
                        <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="{{ Route::current()->uri == '/' ? 'active' : '' }}"> <a
                                        href="{{ route('index') }}">Trang chủ</a> </li>
                                @foreach ($categories as $category)
                                    <li
                                        class=" {{ $category->slug == request()->category_slug ? 'active' : '' }} dropdown hidden-sm">
                                        <a
                                            href="{{ route('category.index', ['category_slug' => $category->slug]) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                                <li class="{{ Route::current()->uri == '/blog' ? 'active' : '' }}"> <a
                                    href="{{ route('blog.view') }}">Tin tức</a> </li>
                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.nav-outer -->
                    </div>
                    <!-- /.navbar-collapse -->

                </div>
                <!-- /.nav-bg-class -->
            </div>
            <!-- /.navbar-default -->
        </div>
        <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>
