@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="index.html">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                        <h3><b>Flipmart</b></h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li>
                <a href="index.html">
                    <i data-feather="pie-chart"></i>
                    <span>Trang chủ</span>
                </a>
            </li>

            <li class="treeview {{ $prefix == '/category' ? 'active' : '' }}  ">
                <a href="#">
                    <i data-feather="mail"></i> <span>Quản lý danh mục </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'all.categories' ? 'active' : '' }}"><a
                            href="{{ route('all.categories') }}"><i class="ti-more"></i>Danh sách danh mục</a>
                    </li>
                    <li class="{{ $route == 'all.sub_categories' ? 'active' : '' }}"><a
                            href="{{ route('all.sub_categories') }}"><i class="ti-more"></i>Danh sách danh mục
                            con</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/product' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="mail"></i> <span>Quản lý sản phẩm</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'all.products' ? 'active' : '' }} "><a href="{{ route('all.products') }}"><i
                                class="ti-more"></i>Danh sách sản phẩm</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/slider' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="mail"></i> <span>Quản lý sliders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'all.sliders' ? 'active' : '' }}"><a href="{{ route('all.sliders') }}"><i class="ti-more"></i>Danh sách sliders</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/slider' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="mail"></i> <span>Quản lý tin tức</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'all.blogs' ? 'active' : '' }}"> <a href="{{ route('all.blogs') }}"><i class="ti-more"></i>Quản lý tin tức</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/review' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="mail"></i> <span>Quản lý đánh giá</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'review.pending' ? 'active' : '' }}"><a href="{{ route('review.pending') }}"><i class="ti-more"></i>Đánh giá chưa công
                            khai</a></li>
                    <li class="{{ $route == 'all.reviews' ? 'active' : '' }}"><a href="{{ route('all.reviews') }}"><i class="ti-more"></i>Đánh giá công khai</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/coupon' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="mail"></i> <span>Quản lý Coupon</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'all.coupons' ? 'active' : '' }}"> <a href="{{ route('all.coupons') }}"><i class="ti-more"></i>Danh sách coupon</a></li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/orders' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="mail"></i> <span>Quản lý đơn hàng</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'all.orders' ? 'active' : '' }}"> <a href="{{ route('all.orders') }}"><i class="ti-more"></i>Danh sách đơn hàng</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Pages</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="profile.html"><i class="ti-more"></i>Profile</a></li>
                    <li><a href="invoice.html"><i class="ti-more"></i>Invoice</a></li>
                    <li><a href="gallery.html"><i class="ti-more"></i>Gallery</a></li>
                    <li><a href="faq.html"><i class="ti-more"></i>FAQs</a></li>
                    <li><a href="timeline.html"><i class="ti-more"></i>Timeline</a></li>
                </ul>
            </li>
        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title=""
            data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="{{ route('admin.logout') }}" class="link" data-toggle="tooltip" title=""
            data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
