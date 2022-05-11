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
                console.log(respone);
            }
        });
    });
})