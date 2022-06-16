$('.user-menu').click(function() {
    $('.show-menu').toggleClass("show");
});

//======================Choose size for product========================
$('#list-size').on('change', function() {
            let sizeId = this.value;

            if ($(`#list-size option:selected`).text() != 'Chọn kích thước' && document.querySelector(`.size-item-${sizeId}`) == null) {

                $('.choose-size').after(` <div class="row">
            <div class="col-md-3">

                <div class="form-group">
                <input type="hidden" name="sizes[]" value="${sizeId}" class="size-item-${sizeId}">
                    <h5>${$(`#list-size option:selected`).text()} <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="amounts[]" class="form-control" placeholder="Vui lòng nhập số lượng sản phẩm">
                    </div>
                </div>

            </div> <!-- end col md 4 -->
        </div>`);
    }

});