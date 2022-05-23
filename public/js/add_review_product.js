$(document).ready(function() {
    let productId = $('.review_product_id').val();

    $('.btn-add-review').click(function(e) {
        e.preventDefault();

        let comment = $('.txt-review').val();
        let stars = $("input[type=radio][name=quality]:checked").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (!comment) {
            $('.review-error').html('Vui lòng nhập nôi dung đánh giá sản phẩm');
        } else {
            $.ajax({
                type: 'POST',
                url: '/product/add-review',
                data: {
                    'product_id': productId,
                    'comment': comment,
                    'rating': stars ? stars : 0
                },
                success: function(respone) {
                    if (respone.status) {
                        location.reload();
                    }
                }
            });
        }
    });
});