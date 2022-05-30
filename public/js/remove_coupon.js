var removeCoupon = function() {
    $.ajax({
        type: "get",
        url: "/checkout/remove-coupon",
        success: function(response) {
            $('.fee-shipping').next('li').remove();
            let sumPriceBegin = response.total_price;
            let feeCharge = parseInt($('input[name="fee_charge"]').val());
            let sumPriceFinal = 0;

            if (feeCharge) {
                sumPriceFinal = sumPriceBegin + feeCharge;
            } else {
                sumPriceFinal = sumPriceBegin;
            }

            $('.apply-coupon').prop('disabled', true);
            $('input[name="sum_price_item"]').val(sumPriceFinal);
            $('.input-coupon').val('');
            $('.input-coupon').placeholder = "Nhập mã giảm giá";
            $('.sum_price_item').html(sumPriceFinal.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' }));
        }
    });
}