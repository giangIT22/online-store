<header class="main-header">
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-30">
        <!-- Sidebar toggle button-->
        <div>
            <ul class="nav">
                <li class="btn-group nav-item">
                    <a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" data-toggle="push-menu"
                        role="button">
                        <i class="nav-link-icon mdi mdi-menu"></i>
                    </a>
                </li>
                <li class="btn-group nav-item">
                    <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded svg-bt-icon"
                        title="Full Screen">
                        <i class="nav-link-icon mdi mdi-crop-free"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                <!-- full Screen -->
                <li class="search-bar">
                    <div class="lookup lookup-circle lookup-right">
                        <input type="text" name="s">
                    </div>
                </li>
                <!-- User Account-->
                <li class="dropdown user user-menu">
                    @php
                        $admin = Auth::guard('admin')->user();
                    @endphp
                    <a href="#" class="waves-effect waves-light rounded dropdown-toggle p-0"
                        title="{{ Auth::guard('admin')->user()->name }}">
                        <img src="{{ $admin->profile_photo_path ? asset($admin->profile_photo_path) : asset('backend/images/no-image.jpg') }}" alt="">
                    </a>
                    <ul class="dropdown-menu animated flipInX show-menu">
                        <li class="user-body">
                            <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                                    class="ti-user text-muted mr-2"></i> Thông tin</a>
                            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i
                                    class="ti-wallet text-muted mr-2"></i>Thay đổi thông tin</a>
                            <a class="dropdown-item" href="{{ route('admin.change.password') }}"><i
                                    class="ti-wallet text-muted mr-2"></i>Thay đổi mật khẩu</a>
                            <a class="dropdown-item" href="#"><i class="ti-settings text-muted mr-2"></i> Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                                    class="ti-lock text-muted mr-2"></i>Đăng xuất</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="control-sidebar" title="Setting" class="waves-effect waves-light">
                        <i class="ti-settings"></i>
                    </a>
                </li>

            </ul>
        </div>
    </nav>
</header>
