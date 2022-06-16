$(document).ready(function() {

    $('.add-cart-product').click(function(e) {
        e.preventDefault();

        let productId = document.querySelector('.product_id').value;
        let amount = document.querySelector('#qty_product').value;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: '/store-cart',
            data: {
                'product_id': productId,
                'amount': amount,
                'size_id': $('.list-size-product').val()
            },
            success: function(response) {
                count = 0;
                sumPrice = 0;
                if (response.status) {
                    //Update box-cart

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

                    let element = document.querySelector('.not-product');
                    if (element !== null) {
                        $('.not-product').remove();
                        console.log('aa');
                        $('.show-list-item-cart').after(`<ul class="dropdown-menu box-cart">
                            <li>
                                <div class="cart-item product-summary list-item-cart">
                                    ${listProducts.join(' ')}
                                </div>
                                <!-- /.cart-item -->
                                <div class="clearfix"></div>
                                <hr>
                                <div class="clearfix cart-total">
                                    <div class="pull-right"> <span class="text">Tổng tiền
                                            :</span><span
                                            class="price sum-price-product">{{ $sum ? number_format($sum, 0, '', '.') . ' vnd' : 0 }}</span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <a href="{{ route('checkout.create') }}"
                                        class="btn btn-upper btn-primary m-t-20 btn-block"
                                        style="font-size: 12px;">Tiến hành
                                        thanh toán</a>
                                    <a href="{{ route('cart.view') }}"
                                        class="btn btn-upper btn-primary m-t-20 btn-block">Giỏ hàng</a>
                                </div>
                                <!-- /.cart-total-->

                            </li>
                        </ul>`);
                    } else {
                        $('.list-item-cart').html(listProducts.join(' '));
                    }

                    for (product of response.products) {
                        count += product.amount;
                        sumPrice += product.amount * product.product_price;
                    }

                    sumPrice = sumPrice.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' });

                    document.querySelector('.basket-item-count').innerHTML = count;
                    document.querySelector('.total-price-basket .value').innerHTML = sumPrice;
                    $('.sum-price-product').text(sumPrice);
                    $('.show-notification').addClass('show-alert');

                    setTimeout(function() {
                        $('.show-notification').removeClass('show-alert');
                    }, 1000)
                } else {
                    window.location.href = '/login';
                }
            }
        });
    });
})