jQuery(document).ready(function() {
    "use strict";

    /*===================================================================================*/
    /*	OWL CAROUSEL
    /*===================================================================================*/
    jQuery(function() {
        var dragging = true;
        var owlElementID = "#owl-main";

        function fadeInReset() {
            if (!dragging) {
                jQuery(owlElementID + " .caption .fadeIn-1, " + owlElementID + " .caption .fadeIn-2, " + owlElementID + " .caption .fadeIn-3").stop().delay(800).animate({ opacity: 0 }, { duration: 400, easing: "easeInCubic" });
            } else {
                jQuery(owlElementID + " .caption .fadeIn-1, " + owlElementID + " .caption .fadeIn-2, " + owlElementID + " .caption .fadeIn-3").css({ opacity: 0 });
            }
        }

        function fadeInDownReset() {
            if (!dragging) {
                jQuery(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3").stop().delay(800).animate({ opacity: 0, top: "-15px" }, { duration: 400, easing: "easeInCubic" });
            } else {
                jQuery(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3").css({ opacity: 0, top: "-15px" });
            }
        }

        function fadeInUpReset() {
            if (!dragging) {
                jQuery(owlElementID + " .caption .fadeInUp-1, " + owlElementID + " .caption .fadeInUp-2, " + owlElementID + " .caption .fadeInUp-3").stop().delay(800).animate({ opacity: 0, top: "15px" }, { duration: 400, easing: "easeInCubic" });
            } else {
                $(owlElementID + " .caption .fadeInUp-1, " + owlElementID + " .caption .fadeInUp-2, " + owlElementID + " .caption .fadeInUp-3").css({ opacity: 0, top: "15px" });
            }
        }

        function fadeInLeftReset() {
            if (!dragging) {
                jQuery(owlElementID + " .caption .fadeInLeft-1, " + owlElementID + " .caption .fadeInLeft-2, " + owlElementID + " .caption .fadeInLeft-3").stop().delay(800).animate({ opacity: 0, left: "15px" }, { duration: 400, easing: "easeInCubic" });
            } else {
                jQuery(owlElementID + " .caption .fadeInLeft-1, " + owlElementID + " .caption .fadeInLeft-2, " + owlElementID + " .caption .fadeInLeft-3").css({ opacity: 0, left: "15px" });
            }
        }

        function fadeInRightReset() {
            if (!dragging) {
                jQuery(owlElementID + " .caption .fadeInRight-1, " + owlElementID + " .caption .fadeInRight-2, " + owlElementID + " .caption .fadeInRight-3").stop().delay(800).animate({ opacity: 0, left: "-15px" }, { duration: 400, easing: "easeInCubic" });
            } else {
                jQuery(owlElementID + " .caption .fadeInRight-1, " + owlElementID + " .caption .fadeInRight-2, " + owlElementID + " .caption .fadeInRight-3").css({ opacity: 0, left: "-15px" });
            }
        }

        function fadeIn() {
            jQuery(owlElementID + " .active .caption .fadeIn-1").stop().delay(500).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
            jQuery(owlElementID + " .active .caption .fadeIn-2").stop().delay(700).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
            jQuery(owlElementID + " .active .caption .fadeIn-3").stop().delay(1000).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
        }

        function fadeInDown() {
            jQuery(owlElementID + " .active .caption .fadeInDown-1").stop().delay(500).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
            jQuery(owlElementID + " .active .caption .fadeInDown-2").stop().delay(700).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
            jQuery(owlElementID + " .active .caption .fadeInDown-3").stop().delay(1000).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        }

        function fadeInUp() {
            jQuery(owlElementID + " .active .caption .fadeInUp-1").stop().delay(500).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
            jQuery(owlElementID + " .active .caption .fadeInUp-2").stop().delay(700).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
            jQuery(owlElementID + " .active .caption .fadeInUp-3").stop().delay(1000).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        }

        function fadeInLeft() {
            jQuery(owlElementID + " .active .caption .fadeInLeft-1").stop().delay(500).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
            jQuery(owlElementID + " .active .caption .fadeInLeft-2").stop().delay(700).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
            jQuery(owlElementID + " .active .caption .fadeInLeft-3").stop().delay(1000).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        }

        function fadeInRight() {
            jQuery(owlElementID + " .active .caption .fadeInRight-1").stop().delay(500).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
            jQuery(owlElementID + " .active .caption .fadeInRight-2").stop().delay(700).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
            jQuery(owlElementID + " .active .caption .fadeInRight-3").stop().delay(1000).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        }

        jQuery(owlElementID).owlCarousel({

            autoPlay: 5000,
            stopOnHover: true,
            navigation: true,
            pagination: true,
            singleItem: true,
            addClassActive: true,
            transitionStyle: "fade",
            navigationText: ["<i class='icon fa fa-angle-left'></i>", "<i class='icon fa fa-angle-right'></i>"],

            afterInit: function() {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            afterMove: function() {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            afterUpdate: function() {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            startDragging: function() {
                dragging = true;
            },

            afterAction: function() {
                fadeInReset();
                fadeInDownReset();
                fadeInUpReset();
                fadeInLeftReset();
                fadeInRightReset();
                dragging = false;
            }

        });

        if (jQuery(owlElementID).hasClass("owl-one-item")) {
            jQuery(owlElementID + ".owl-one-item").data('owlCarousel').destroy();
        }

        jQuery(owlElementID + ".owl-one-item").owlCarousel({
            singleItem: true,
            navigation: false,
            pagination: false
        });




        jQuery('.home-owl-carousel').each(function() {

            var owl = $(this);
            var itemPerLine = owl.data('item');
            if (!itemPerLine) {
                itemPerLine = 4;
            }
            owl.owlCarousel({
                items: itemPerLine,
                itemsTablet: [768, 2],
                navigation: true,
                pagination: false,

                navigationText: ["", ""]
            });
        });

        jQuery('.homepage-owl-carousel').each(function() {

            var owl = $(this);
            var itemPerLine = owl.data('item');
            if (!itemPerLine) {
                itemPerLine = 4;
            }
            owl.owlCarousel({
                items: itemPerLine,
                itemsTablet: [768, 2],
                itemsDesktop: [1199, 2],
                navigation: true,
                pagination: false,

                navigationText: ["", ""]
            });
        });

        jQuery(".blog-slider").owlCarousel({
            items: 2,
            itemsDesktopSmall: [979, 2],
            itemsDesktop: [1199, 2],
            navigation: true,
            slideSpeed: 300,
            pagination: false,
            navigationText: ["", ""]
        });

        jQuery(".best-seller").owlCarousel({
            items: 3,
            navigation: true,
            itemsDesktopSmall: [979, 2],
            itemsDesktop: [1199, 2],
            slideSpeed: 300,
            pagination: false,
            paginationSpeed: 400,
            navigationText: ["", ""]
        });

        jQuery(".sidebar-carousel").owlCarousel({
            items: 1,
            itemsTablet: [768, 2],
            itemsDesktopSmall: [979, 2],
            itemsDesktop: [1199, 1],
            navigation: true,
            slideSpeed: 300,
            pagination: false,
            paginationSpeed: 400,
            navigationText: ["", ""]
        });

        jQuery(".brand-slider").owlCarousel({
            items: 6,
            navigation: true,
            slideSpeed: 300,
            pagination: false,
            paginationSpeed: 400,
            navigationText: ["", ""]
        });
        jQuery("#advertisement").owlCarousel({
            items: 1,
            itemsDesktopSmall: [979, 2],
            itemsDesktop: [1199, 1],
            navigation: true,
            slideSpeed: 300,
            pagination: true,
            paginationSpeed: 400,
            navigationText: ["", ""]
        });



    });

    /*===================================================================================*/
    /*  LAZY LOAD IMAGES USING ECHO
    /*===================================================================================*/
    jQuery(function() {
        echo.init({
            offset: 100,
            throttle: 250,
            unload: false
        });
    });

    /*===================================================================================*/
    /*  RATING
    /*===================================================================================*/

    jQuery(function() {
        jQuery('.rating').rateit({ max: 5, step: 1, value: 4, resetable: false, readonly: true });
    });

    /*===================================================================================*/
    /* PRICE SLIDER
    /*===================================================================================*/
    jQuery(function() {

        // Price Slider
        if (jQuery('.price-slider').length > 0) {
            jQuery('.price-slider').slider({
                min: 100,
                max: 700,
                step: 10,
                value: [200, 500],
                handle: "square"

            });

        }

    });


    /*===================================================================================*/
    /* SINGLE PRODUCT GALLERY
    /*===================================================================================*/
    jQuery(function() {
        jQuery('#owl-single-product').owlCarousel({
            items: 1,
            itemsTablet: [768, 2],
            itemsDesktop: [1199, 1]

        });

        jQuery('#owl-single-product-thumbnails').owlCarousel({
            items: 4,
            pagination: true,
            rewindNav: true,
            itemsTablet: [768, 4],
            itemsDesktop: [1199, 3]
        });

        jQuery('#owl-single-product2-thumbnails').owlCarousel({
            items: 6,
            pagination: true,
            rewindNav: true,
            itemsTablet: [768, 4],
            itemsDesktop: [1199, 3]
        });

        jQuery('.single-product-slider').owlCarousel({
            stopOnHover: true,
            rewindNav: true,
            singleItem: true,
            pagination: true
        });


    });





    /*===================================================================================*/
    /*  WOW 
    /*===================================================================================*/

    // jQuery(function () {
    //     new WOW().init();
    // });


    /*===================================================================================*/
    /*  TOOLTIP 
    /*===================================================================================*/
    jQuery("[data-toggle='tooltip']").tooltip();


    //==============================GET FEE-SHIPPING======================================
    //===============Show list province==================================
    $.ajax({
        url: `https://online-gateway.ghn.vn/shiip/public-api/master-data/province`,
        type: "GET",
        dataType: "json",
        headers: { "token": "84ee5499-de95-11ec-b912-56b1b0c59a25" },
        success: function(response) {
            let provinces = response.data.map(function(province) {
                return `<option value=${province.ProvinceID}>${province.ProvinceName}</option>`
            });

            provinces.unshift('<option selected>---</option>');
            $('.choose-province').html(provinces.join(' '));
        }
    });

    //=========================Show list district when change province=======================
    $('.choose-province').change(function() {
        $('.choose-district').html('');
        $('.choose-ward').html('');
        $('#province_name').val($('.choose-province option:selected').text());

        if ($('.choose-province').val() == "---") {
            $('.transport').html(`<div class="alert alert-info" role="alert">
                    Vui lóng nhập thông tin giao hàng
                </div>`)
        } else {
            $.ajax({
                url: `https://online-gateway.ghn.vn/shiip/public-api/master-data/district`,
                type: "get",
                headers: { "token": "84ee5499-de95-11ec-b912-56b1b0c59a25" },
                data: {
                    province_id: $('.choose-province').val()
                },
                success: function(response) {
                    let districts = response.data.map(function(district) {
                        return `<option value=${district.DistrictID}>${district.DistrictName}</option>`
                    });

                    districts.unshift('<option selected>---</option>');
                    $('.choose-district').html(districts.join(' '));
                }
            });
        }
    });

    //======================Show list ward when change district================================
    $('.choose-district').change(function() {
        $('#district_name').val($('.choose-district option:selected').text());

        $.ajax({
            url: `https://online-gateway.ghn.vn/shiip/public-api/master-data/ward`,
            type: "get",
            headers: { "token": "84ee5499-de95-11ec-b912-56b1b0c59a25" },
            data: {
                district_id: $('.choose-district').val()
            },
            success: function(response) {
                let wards = response.data.map(function(ward) {
                    return `<option value=${ward.WardCode}>${ward.WardName}</option>`
                });

                wards.unshift('<option selected>---</option>');
                $('.choose-ward').html(wards.join(' '));
            }
        });
    });


    //=============================final when change ward will execute call api to fee of charge=====================
    $('.choose-ward').change(function() {
        $('#ward_name').val($('.choose-ward option:selected').text());

        let province = $('.choose-province').val();
        let district = $('.choose-district').val();
        let ward = $('.choose-ward').val();
        let feeCharges = 0;

        if (province != null && district != null && ward != null) {
            let serviceId = 0;

            $.ajax({
                url: `https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services`,
                type: "get",
                headers: { "token": "84ee5499-de95-11ec-b912-56b1b0c59a25" },
                data: {
                    shop_id: 2977543,
                    from_district: 1542,
                    to_district: district
                },
                success: function(response) {
                    serviceId = response.data[0].service_id;
                    console.log(serviceId);
                    if (serviceId) {
                        $.ajax({
                            url: `https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee`,
                            type: "get",
                            headers: {
                                "token": "84ee5499-de95-11ec-b912-56b1b0c59a25",
                                "shop_id": 2977543
                            },
                            data: {
                                "service_id": serviceId,
                                "insurance_value": 0,
                                "coupon": null,
                                "from_district_id": 1542,
                                "to_district_id": district,
                                "to_ward_code": ward,
                                "height": 8,
                                "length": 30,
                                "weight": 1000,
                                "width": 8
                            },
                            success: function(response) {
                                feeCharges = response.data.total;
                                $('.transport').html(`<input 
                                    type"text" 
                                    class="fee_charge" 
                                    disabled="true" 
                                    value=${feeCharges.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' })}>
                                    <input type="hidden" name="fee_charge" value=${feeCharges}>`)
                                $('.fee_charge_item').html(feeCharges.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' }));

                                let sumPrice = parseInt($('input[name="sum_price"]').val()) + feeCharges;

                                $('input[name="sum_price"]').val(sumPrice);
                                $('.sum_price_item').html(sumPrice.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' }));
                            }
                        });
                    }
                }
            });
        }
    });

    //============================Apply coupon====================================

    if ($('.input-coupon').val() == '') {
        $('.apply-coupon').prop('disabled', true);
    }

    $('.input-coupon').on('input', function() {
        $('.apply-coupon').prop('disabled', false);
    });

    $('.input-coupon').on('blur', function() {
        if ($('.input-coupon').val() == '') {
            $('.apply-coupon').prop('disabled', true);

            if ($('.input-coupon + span')) {
                $('.input-coupon + span').remove();
            }
        }
    });


    $('.apply-coupon').click(function(e) {
        e.preventDefault();
        let couponName = $('.input-coupon').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: "/checkout/apply-coupon",
            data: {
                'coupon_name': couponName
            },
            success: function(response) {
                if (response.status) {
                    let sumPriceBegin = response.total_price;
                    let feeCharge = parseInt($('input[name="fee_charge"]').val());
                    let discountAmount = ((sumPriceBegin * response.coupon_discount) / 100);
                    let sumPriceAfterApplyCoupon = sumPriceBegin - discountAmount;
                    let sumPriceFinal = 0;

                    if (feeCharge) {
                        sumPriceFinal = sumPriceAfterApplyCoupon + feeCharge;
                    } else {
                        sumPriceFinal = sumPriceAfterApplyCoupon
                    }

                    $('.fee-shipping').after(`<li class="list-group-item bg-light">
                        <div class="text-success fix-flex">
                            <h6 class="my-0">Mã giảm giá (${couponName})</h6>
                            <div>
                                <span>- ${discountAmount.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' })}</span>
                                <span id="remove-coupon" style="cursor:pointer;" onclick="removeCoupon()"><i class="fa fa-times" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </li>`);

                    if ($('.input-coupon + span')) {
                        $('.input-coupon + span').remove();
                    }

                    $('.apply-coupon').prop('disabled', true);
                    $('input[name="sum_price"]').val(sumPriceFinal);
                    $('.sum_price_item').html(sumPriceFinal.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' }));
                } else {
                    if ($('.input-coupon + span')) {
                        $('.input-coupon + span').remove();
                        $('.input-coupon').after(`<span class="text-danger">Mã khuyến mại không hợp lệ</span>`);
                    } else {
                        $('.input-coupon').after(`<span class="text-danger">Mã khuyến mại không hợp lệ</span>`);
                    }
                }
            }
        });
    });

    //===================================Event for cart page ===============================
    $('.qty-plus').each(function(i, obj) {
        $(obj).click(function() {
            $(obj).parent().next().val(parseInt($(obj).parent().next().val()) + 1);
            let index = $(obj).attr('id').indexOf('-');
            let productId = $(obj).attr('id').slice(0, index);
            let sizeId = $(obj).attr('id').slice(index + 1);
            let amount = $(`#qty-input-${productId}-${sizeId}`).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: '/cart/update',
                data: {
                    'product_id': productId,
                    'amount': amount,
                    'size_id': sizeId
                },
                success: function(response) {
                    let sumPrice = response.product.amount * response.product.price;
                    $(`#sum-${productId}-${sizeId}`).text(sumPrice.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' }));
                    $('.cart-grand-total span').text(response.sumTotal.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' }));
                    $('.sum-price-product').text(response.sumTotal.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' }));
                    $('.total-price-basket .value').text(response.sumTotal.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' }));
                    $('.basket-item-count').text(response.count);
                }
            });
        });
    });

    $('.qty-minus').each(function(i, obj) {
        $(obj).click(function() {
            $(obj).parent().next().val(parseInt($(obj).parent().next().val()) - 1);

            if ($(obj).parent().next().val() == 0) {
                $(obj).parent().next().val(1);
            }

            let index = $(obj).attr('id').indexOf('-');
            let productId = $(obj).attr('id').slice(0, index);
            let sizeId = $(obj).attr('id').slice(index + 1);
            let amount = $(`#qty-input-${productId}-${sizeId}`).val();
            console.log(productId, sizeId, amount);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: '/cart/update',
                data: {
                    'product_id': productId,
                    'amount': amount,
                    'size_id': sizeId
                },
                success: function(response) {
                    let sumPrice = response.product.amount * response.product.price;
                    $(`#sum-${productId}-${sizeId}`).text(sumPrice.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' }));
                    $('.cart-grand-total span').text(response.sumTotal.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' }));
                    $('.sum-price-product').text(response.sumTotal.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' }));
                    $('.total-price-basket .value').text(response.sumTotal.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' }));
                    $('.basket-item-count').text(response.count);
                }
            });
        });
    });


    //===============remove-cart=====================
    $('.cart-cancel').click(function(e) {
        e.preventDefault();

        let start = $(this).attr('id').indexOf('-');
        let finish = $(this).attr('id').lastIndexOf('-');
        let productId = $(this).attr('id').slice(start + 1, finish);
        let sizeId = $(this).attr('id').slice(finish + 1);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: '/delete-cart',
            data: {
                'product_id': productId,
                'size_id': sizeId
            },
            success: function(response) {
                let count = 0;
                let sumPrice = 0;
                if (response.status) {
                    $(`#cancel-${productId}-${sizeId}`).parent().parent().remove();

                    //update box-cart
                    if (response.products.length > 0) {
                        let listProducts = response.products.map((product) => {
                            let priceProduct = product.product_price.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' });
                            return `<div class="row" style="margin-bottom: 10px;">
                            <div class="col-xs-4">
                                <div class="image"> <a
                                        href="/product/detail/${product.product_id}/${product.product_slug}"><img
                                            src="${product.product_image}"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <h3 class="name"><a
                                        href="/product/detail/${product.product_id}/${product.product_slug}">${product.product_name}</a>
                                </h3>
                                <div class="price">
                                    ${priceProduct}
                                </div>
                            </div>
                        </div>`
                        });

                        $('.list-item-cart').html(listProducts.join(' '));
                    }

                    if (response.products.length > 0) {
                        for (let product of response.products) {
                            count += product.amount;
                            sumPrice += product.amount * product.product_price;
                        }

                        sumPrice = sumPrice.toLocaleString('it-IT', {
                            style: 'currency',
                            currency: 'vnd'
                        });
                        document.querySelector('.basket-item-count').innerHTML = count;
                        document.querySelector('.basket-item-count').innerHTML = count;
                        document.querySelector('.total-price-basket .value').innerHTML = sumPrice;
                        $('.sum-price-product').text(sumPrice);
                    } else {
                        document.querySelector('.basket-item-count').innerHTML = count;
                        document.querySelector('.total-price-basket .value').innerHTML = sumPrice;
                    }
                }

                if (response.flag) {
                    $('.box-cart').remove();
                    $('.show-list-item-cart').after(`<div class="dropdown-menu not-product">
                            Không có sản phẩm nào trong giỏ hàng
                        </div>`);
                    $('.shopping-cart').remove();
                    $('.cart').html(`<div class="not-cart">
                                    <h1>Giỏ hàng</h2>
                                    <h4>Không có sản phẩm nào trong giỏ hàng. Quay lại cửa hàng để tiếp tục mua sắm.</p>
                                    </div>`);
                }
            }
        });
    });

    //=================Check exist product=======================================
    $('.list-size-product').on('change', function() {
        let productId = $('.product_id').val();

        if ($(this).val() != 'Chọn kích thước') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: '/product/check-exist',
                data: {
                    product_id: productId,
                    size_id: $(this).val(),
                },
                success: function(response) {
                    if (response.status) {
                        $('.add-cart-product').prop('disabled', false);
                        $('.stock-box span.value').text('Còn hàng');
                    } else {
                        $('.add-cart-product').prop('disabled', true);
                        $('.stock-box span.value').text('Hết hàng');
                    }
                }
            });
        } else {
            $('.add-cart-product').prop('disabled', true);
        }
    });
})