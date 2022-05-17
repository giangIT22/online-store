@extends('layouts.guest')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Trang chủ</a></li>/
                    <li class='active'>Giỏ hàng</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row ">
                @if (Auth::check())
                    <div class="shopping-cart">
                        <div class="shopping-cart-table ">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-description item">Ảnh sản phẩm </th>
                                            <th class="cart-product-name item">Tên sản phầm</th>
                                            <th class="cart-qty item">Đơn giá</th>
                                            <th class="cart-qty item">Số lượng</th>
                                            <th class="cart-sub-total item">Thành tiền</th>
                                            <th class="cart-romove item">Xóa</th>
                                        </tr>
                                    </thead><!-- /thead -->
                                    <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <div class="shopping-cart-btn">
                                                    <span class="">
                                                        <a href="#" class="btn btn-upper btn-primary outer-left-xs">Tiếp tục
                                                            mua hàng</a>
                                                        <a href="#"
                                                            class="btn btn-upper btn-primary pull-right outer-right-xs">Cập
                                                            nhật giỏ hàng</a>
                                                    </span>
                                                </div><!-- /.shopping-cart-btn -->
                                            </td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($carts as $cart)
                                            <tr>
                                                <td class="cart-image">
                                                    <a class="entry-thumbnail" href="detail.html">
                                                        <img src="{{ asset($cart->product_image)}}" alt="">
                                                    </a>
                                                </td>
                                                <td class="cart-product-name-info">
                                                    <h4 class='cart-product-description'>
                                                        <a href="detail.html">{{$cart->product_name}}</a>
                                                    </h4>
                                                    {{-- <div class="cart-product-info">
                                                            <span class="product-color">COLOR:<span>Blue</span></span>
                                                    </div> --}}
                                                </td>
                                                <td class="cart-product-sub-total"><span
                                                        class="cart-sub-total-price">{{number_format($cart->product_price)}} VND</span>
                                                <td class="cart-product-quantity">
                                                    <div class="quant-input">
                                                        <div class="arrows">
                                                            <div class="arrow plus gradient qty-plus" id="plus-{{$cart->id}}"><span
                                                                    class="ir"><i
                                                                        class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient qty-minus" id="minus-{{$cart->id}}"><span
                                                                    class="ir"><i
                                                                        class="icon fa fa-sort-desc"></i></span></div>
                                                        </div>
                                                        <input type="text" value="{{ $cart->amount}}" class="qty-input">
                                                    </div>
                                                </td>
                                                <td class="cart-product-sub-total"><span
                                                        class="cart-sub-total-price">{{number_format($cart->product_price * $cart->amount)}} VND</span>
                                                </td>
                                                <td class="romove-item"><a href="#" title="cancel" id="{{$cart->id}}"
                                                        class="icon cart-cancel"><i class="fa fa-trash-o"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody><!-- /tbody -->
                                </table><!-- /table -->
                            </div>
                        </div><!-- /.shopping-cart-table -->
                        <div class="col-md-4 col-sm-12 estimate-ship-tax">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <span class="estimate-title">Estimate shipping and tax</span>
                                            <p>Enter your destination to get shipping and tax.</p>
                                        </th>
                                    </tr>
                                </thead><!-- /thead -->
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label class="info-title control-label">Country <span>*</span></label>
                                                <select class="form-control unicase-form-control selectpicker">
                                                    <option>--Select options--</option>
                                                    <option>India</option>
                                                    <option>SriLanka</option>
                                                    <option>united kingdom</option>
                                                    <option>saudi arabia</option>
                                                    <option>united arab emirates</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title control-label">State/Province
                                                    <span>*</span></label>
                                                <select class="form-control unicase-form-control selectpicker">
                                                    <option>--Select options--</option>
                                                    <option>TamilNadu</option>
                                                    <option>Kerala</option>
                                                    <option>Andhra Pradesh</option>
                                                    <option>Karnataka</option>
                                                    <option>Madhya Pradesh</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title control-label">Zip/Postal Code</label>
                                                <input type="text" class="form-control unicase-form-control text-input"
                                                    placeholder="">
                                            </div>
                                            <div class="pull-right">
                                                <button type="submit" class="btn-upper btn btn-primary">GET A QOUTE</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- /.estimate-ship-tax -->

                        <div class="col-md-4 col-sm-12 estimate-ship-tax">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <span class="estimate-title">Discount Code</span>
                                            <p>Enter your coupon code if you have one..</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control unicase-form-control text-input"
                                                    placeholder="You Coupon..">
                                            </div>
                                            <div class="clearfix pull-right">
                                                <button type="submit" class="btn-upper btn btn-primary">APPLY
                                                    COUPON</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody><!-- /tbody -->
                            </table><!-- /table -->
                        </div><!-- /.estimate-ship-tax -->

                        <div class="col-md-4 col-sm-12 cart-shopping-total">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="cart-sub-total">
                                                Subtotal<span class="inner-left-md">$600.00</span>
                                            </div>
                                            <div class="cart-grand-total">
                                                Grand Total<span class="inner-left-md">$600.00</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead><!-- /thead -->
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="cart-checkout-btn pull-right">
                                                <button type="submit" class="btn btn-primary checkout-btn">PROCCED TO
                                                    CHEKOUT</button>
                                                <span class="">Checkout with multiples address!</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody><!-- /tbody -->
                            </table><!-- /table -->
                        </div><!-- /.cart-shopping-total -->
                    </div><!-- /.shopping-cart -->
                @else
                    <div class="not-cart">
                        <h1>Giỏ hàng</h2>
                            <h4>Không có sản phẩm nào trong giỏ hàng. Quay lại cửa hàng để tiếp tục mua sắm.</p>
                    </div>
                @endif
            </div> <!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection

@push('script')
    <script>
        let i = 1;

        $('.qty-plus').each(function(i, obj) {
            $(obj).click(function(){
                $(obj).parent().next().val(parseInt($(obj).parent().next().val()) + 1);
            });
        });
        
        $('.qty-minus').each(function(i, obj) {
            $(obj).click(function(){
                $(obj).parent().next().val(parseInt($(obj).parent().next().val()) - 1);

                if ($(obj).parent().next().val() == 0) {
                    $(obj).parent().next().val(1);
                }
            });
        });

        $('.cart-cancel').click(function(e){
            e.preventDefault();

            cartId = $(this).attr('id');
            
            $.ajax({
                method: "POST",
                url: '/store-cart',
                data: {
                    'cart_id': cartId,
                },
                success: function(respone) {
                    
                }
            });
        });
    </script>
@endpush
