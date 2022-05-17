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
                'amount': amount
            },
            success: function(respone) {
                count = 0;
                sumPrice = 0;

                if (respone.status) {
                    for (cart of respone.carts) {
                        count += cart.amount;
                        sumPrice += cart.amount * cart.product_price;
                    }

                    sumPrice = sumPrice.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' });

                    document.querySelector('.basket-item-count').innerHTML = count;
                    document.querySelector('.total-price-basket .value').innerHTML = sumPrice;
                } else {
                    window.location.href = '/login';
                }
            }
        });
    });
})