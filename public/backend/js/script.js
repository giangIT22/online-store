$('.user-menu').click(function() {
    $('.show-menu').toggleClass("show");
});

//======================Choose option for product========================
//===============Add option================
var i = 1;
$('.add-option').on('click', function() {
    var itemOption = '';
    if (i == 1) {
        var size = $(`.choose-option #row-1 #list-color option:selected`).text();
        var color = $(`.choose-option #row-1 #list-size option:selected`).text();
        var amount = $(`.choose-option #row-1 #option-amount`).val();
        if (size != 'Chọn màu sắc' && color != 'Chọn kích thước' && amount != '') {
            ++i;
            itemOption = `<div id="row-${i}" class="row row-${i} col-md-9 option-item">
            ${document.querySelector('.choose-option').firstElementChild.innerHTML}</div>
            <div class="col-md-2">
                <div class="close-option">
                    <span><i class="fa fa-times" aria-hidden="true"></i>
                    </span>
                </div>
            </div>`;
            $('.choose-option').append(itemOption);
        }
    } else if (i > 1) {
        var size = $(`.choose-option #row-${i} #list-color option:selected`).text();
        var color = $(`.choose-option #row-${i} #list-size option:selected`).text();
        var amount = $(`.choose-option #row-${i} #option-amount`).val();

        if (size != 'Chọn màu sắc' && color != 'Chọn kích thước' && amount != '') {
            ++i;
            itemOption = `<div id="row-${i}" class="row col-md-9 option-item">
            ${document.querySelector('.choose-option').firstElementChild.innerHTML}</div>
            <div class="col-md-2">
                <div class="close-option">
                    <span><i class="fa fa-times" aria-hidden="true"></i>
                    </span>
                </div>
            </div>`;
            $('.choose-option').append(itemOption);
        }
    }
});

//===============Close option ========================
$('.close-option').on('click', function() {
    console.log($(this).prev());
});