@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
    
@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ route('invoice.monthy') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="">
                        {{-- <h3><b>Fowler Shoes</b></h3> --}}
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ $route == 'invoice.monthy' ? 'active' : '' }}">
                <a href="{{ route('invoice.monthy') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-pie-chart">
                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                        <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                    </svg>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li class="{{ $route == 'all.products' ? 'active' : '' }}">
                <a href="{{ route('all.products') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-pie-chart">
                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                        <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                    </svg>
                    <span>Sản phẩm</span>
                </a>
            </li>

            <li class="{{ $route == 'all.receipts' ? 'active' : '' }}">
                <a href="{{ route('all.receipts') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-pie-chart">
                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                        <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                    </svg>
                    <span>Quản lý nhập kho</span>
                </a>
            </li>

            <li class="treeview {{ $prefix == '/category' ? 'active' : '' }}  ">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-grid">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span>Quản lý danh mục </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'all.categories' ? 'active' : '' }}"><a
                            href="{{ route('all.categories') }}"><i class="ti-more"></i>Quản lý danh mục sản phẩm</a>
                    </li>
                    <li class="{{ $route == 'all.sub_categories' ? 'active' : '' }}"><a
                            href="{{ route('all.sub_categories') }}"><i class="ti-more"></i>Quản lý danh mục
                            con</a>
                    </li>
                    <li class="{{ $route == 'all.companies' ? 'active' : '' }}"><a
                            href="{{ route('all.companies') }}"><i class="ti-more"></i>Quản lý nhà cung cấp</a>
                    </li>
                    <li class="{{ $route == 'all.coupons' ? 'active' : '' }}"><a
                            href="{{ route('all.coupons') }}"><i class="ti-more"></i>Quản lý mã giảm giá</a>
                    </li>
                    <li class="{{ $route == 'all.blogs' ? 'active' : '' }}"><a
                            href="{{ route('all.blogs') }}"><i class="ti-more"></i>Quản lý bài viết</a>
                    </li>
                    <li class="{{ $route == 'all.sliders' ? 'active' : '' }}"><a
                            href="{{ route('all.sliders') }}"><i class="ti-more"></i>Quản lý banner</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/review' ? 'active' : '' }}">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-grid">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span>Đánh giá</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'review.pending' ? 'active' : '' }}"><a
                            href="{{ route('review.pending') }}"><i class="ti-more"></i>Đánh giá chưa công
                            khai</a></li>
                    <li class="{{ $route == 'all.reviews' ? 'active' : '' }}"><a
                            href="{{ route('all.reviews') }}"><i class="ti-more"></i>Đánh giá công khai</a>
                    </li>
                </ul>
            </li>

            <li class="{{ $route == 'all.orders' ? 'active' : '' }}">
                <a href="{{ route('all.orders') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-pie-chart">
                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                        <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                    </svg>
                    <span>Đơn hàng</span>
                </a>
            </li>

            <li class="{{ $route == 'all.users' ? 'active' : '' }}">
                <a href="{{ route('all.users') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-pie-chart">
                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                        <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                    </svg>
                    <span>Người dùng</span>
                </a>
            </li>

            <li class="{{ $route == 'all.employees' ? 'active' : '' }}">
                <a href="{{ route('all.employees') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-pie-chart">
                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                        <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                    </svg>
                    <span>Nhân viên</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
