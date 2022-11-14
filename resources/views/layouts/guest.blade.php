<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $titlePage ?? 'Fowler Shoes' }}</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">
    <link rel="icon" href="{{ asset('backend/images/favicon.ico') }}">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    @stack('css')
</head>

<body class="cnt-home">
    <div id="app">
        <!-- ============================================== HEADER ============================================== -->
        @include('partitions.web.header')

        <!-- ============================================== HEADER : END ============================================== -->
        @yield('content')

        <!-- ============================================================= FOOTER ============================================================= -->
        @include('partitions.web.footer')
        <!-- ============================================================= FOOTER : END============================================================= -->
        <div class="alert alert-success show-notification" role="alert">
            Sản phẩm đã được thêm vào giỏ hàng
        </div>
        @php
            $coupons = DB::table('coupons')
                ->where('status', 1)
                ->get();
        @endphp
        <div class="list-coupon">
            <div class="detail-list-counpon">
                <h3>Danh sách mã giảm giá <span class="close-coupon"><i class="fa fa-times" aria-hidden="true"></i>
                </span></h3>
                @foreach ($coupons as $item)
                    <div class="item">
                        <p>Giảm : {{ $item->coupon_discount }}%</p>
                        <p>Đơn hàng từ : {{ number_format($item->minimum_price, 0, '', '.') }} đ</p>
                        <div class="expried">
                            <div class="code-item">
                                <p class="">Mã: {{ $item->coupon_name }}</p>
                                <p>HSD: {{ $item->coupon_validity }}</p>
                            </div>
                            <button 
                                class="coppy-code" 
                                data-code-coupon="{{ $item->coupon_name }}"
                                >Sao chép mã</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <button class="btn-show-coupon">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                xmlns:svgjs="http://svgjs.com/svgjs" width="25" height="25" x="0" y="0"
                viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                <g>
                    <g xmlns="http://www.w3.org/2000/svg" id="coupon">
                        <path
                            d="m57 25.875c.553 0 1-.447 1-1v-8.875c0-1.654-1.346-3-3-3h-23-23c-1.654 0-3 1.346-3 3v8.875c0 .553.447 1 1 1 3.309 0 6 2.691 6 6s-2.691 6-6 6c-.553 0-1 .447-1 1 0 .022.012.041.013.063-.001.021-.013.04-.013.062v9c0 1.654 1.346 3 3 3h23 23c1.654 0 3-1.346 3-3v-9.125c0-.553-.447-1-1-1-3.309 0-6-2.691-6-6s2.691-6 6-6zm-8 6c0 4.072 3.061 7.436 7 7.931v8.194c0 .552-.448 1-1 1h-33v-4c0-.553-.447-1-1-1s-1 .447-1 1v4h-11c-.552 0-1-.448-1-1v-8.194c3.939-.495 7-3.858 7-7.931s-3.061-7.436-7-7.931v-7.944c0-.552.448-1 1-1h11v4c0 .553.447 1 1 1s1-.447 1-1v-4h33c.552 0 1 .448 1 1v7.944c-3.939.495-7 3.859-7 7.931zm-27-7.875v5c0 .553-.447 1-1 1s-1-.447-1-1v-5c0-.553.447-1 1-1s1 .447 1 1zm0 11v5c0 .553-.447 1-1 1s-1-.447-1-1v-5c0-.553.447-1 1-1s1 .447 1 1zm14-10c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5zm-8 0c0-1.654 1.346-3 3-3s3 1.346 3 3-1.346 3-3 3-3-1.346-3-3zm14 9c-2.757 0-5 2.243-5 5s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5zm0 8c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3zm2.769-18.359-15 18c-.199.237-.483.359-.77.359-.226 0-.452-.076-.64-.231-.424-.354-.481-.984-.128-1.409l15-18c.354-.424.983-.481 1.409-.128.424.353.482.984.129 1.409z"
                            fill="#000000" data-original="#000000" class=""></path>
                    </g>
                </g>
            </svg>
        <span>Danh sách mã giảm giá</span></button>
        <div class="coppy-coupon-success">
            <div class="success">
                <img src="{{ asset('frontend/assets/images/success.svg') }}" alt="">
                <h3>Tuyệt vời !</h3>
                <p>Sao chép mã thành công</p>
                <button class="close-success-coupon">OK</button>
            </div>
        </div>
    </div>
    <!-- For demo purposes – can be removed on production -->

    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
    {{-- <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script> --}}
    <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
    @stack('script')
</body>

</html>
