$(document).ready(function() {

    $('.preview-product').click(function(e) {
        e.preventDefault();
        let productId = $(this).attr('id');
        document.querySelector('.modal-product').classList.add('modal-show');
        $.ajax({
            method: "GET",
            url: `/product/preview-product/${productId}`,
            success: function(respone) {
                if (respone) {
                    multiImage1 = respone.multi_images.map(function(image) {
                        return `<div class="single-product-gallery-item" id="slide${image.id }">
                                    <a data-lightbox="image-1" data-title="Gallery"
                                        href="${image.image_path}">
                                    <img class="img-responsive" alt=""
                                        src="http://localhost:8089${image.image_path}"
                                        data-echo="${image.image_path}" />
                                    </a>
                                </div>`
                    });

                    document.getElementById('owl-single-product').innerHTML = multiImage1.join(' ');

                    multiImage2 = respone.multi_images.map(function(image) {
                        return `<div class="item">
                                    <a class="horizontal-thumb active" data-target="#owl-single-product"
                                        data-slide="${image.id}" href="#slide${image.id }">
                                    <img class="img-responsive" width="85" alt=""
                                        src="${image.image_path}"
                                        data-echo="${image.image_path}" />
                                    </a>
                                </div>`
                    });
                    document.getElementById('owl-single-product-thumbnails').innerHTML = multiImage2.join(' ');

                    console.log(respone.product_detail.name);
                    document.querySelector('.product-info h1.name').innerHTML = respone.product_detail.name;
                    document.querySelector('.product-info .description-container').innerHTML = respone.product_detail.description;
                }
            }
        });
    });

    $('.close-modal').click(function() {
        document.querySelector('.modal-product').classList.remove('modal-show');
    });
})