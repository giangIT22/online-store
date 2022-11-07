$('.user-menu').click(function() {
    $('.show-menu').toggleClass("show");
});

//======================Choose option for product========================
//===============Add option================
var i = 1;
$('.add-option').on('click', function() {
    var itemOption = '';
    if (i == 1) {
        var product = $(`#option-row-1 #list-product option:selected`).text();
        var size = $(`#option-row-1 #list-color option:selected`).text();
        var color = $(`#option-row-1 #list-size option:selected`).text();
        var amount = $(`#option-row-1 #import_amount_1`).val();
        var price = $(`#option-row-1 #import_price`).val();

        if (product != 'Chọn sản phẩm' &&
            size != 'Chọn màu sắc' &&
            color != 'Chọn kích thước' &&
            amount != '' && price != ''
        ) {
            ++i;
            itemOption = `<tr id="option-row-${i}">${document.querySelector('#option-row-1').innerHTML}</tr>`;
            $('.choose-option').append(itemOption);
            $(`#option-row-${i}`).append(`<td>
                <a href="#" class="remove-first">
                    <i class="fa fa-trash"></i></a>
            </td>`);
            document.querySelector(`#option-row-${i}`).lastElementChild.querySelector('a').setAttribute('id', `remove-option-${i}`);
            document.querySelector(`#option-row-${i}`).lastElementChild.querySelector('a').setAttribute('class', `remove-option`);
            document.querySelector(`#option-row-${i}`).lastElementChild.querySelector('a').setAttribute('onclick', `removeOption('#option-row-${i}')`);
            $(`#option-row-${i} #import_amount_1`).attr('id', `import_amount_${i}`);
            $(`#option-row-${i} #import_price_1`).attr('id', `import_price_${i}`);
            $(`#option-row-${i} #sum_price_1`).attr('id', `sum_price_${i}`);
        }
    } else if (i > 1) {
        var product = $(`#option-row-${i} #list-product option:selected`).text();
        var size = $(`#option-row-${i} #list-color option:selected`).text();
        var color = $(`#option-row-${i} #list-size option:selected`).text();
        var amount = $(`#option-row-${i} #import_amount_${i}`).val();
        var price = $(`#option-row-${i} #import_price`).val();

        if (product != 'Chọn sản phẩm' &&
            size != 'Chọn màu sắc' &&
            color != 'Chọn kích thước' &&
            amount != '' && price != ''
        ) {
            ++i;
            itemOption = `<tr id="option-row-${i}">${document.querySelector('#option-row-1').innerHTML}</tr>`;
            $('.choose-option').append(itemOption);
            $(`#option-row-${i}`).append(`<td>
                <a href="#" class="remove-first">
                    <i class="fa fa-trash"></i></a>
            </td>`);
            document.querySelector(`#option-row-${i}`).lastElementChild.querySelector('a').setAttribute('id', `remove-option-${i}`);
            document.querySelector(`#option-row-${i}`).lastElementChild.querySelector('a').setAttribute('class', `remove-option`);
            document.querySelector(`#option-row-${i}`).lastElementChild.querySelector('a').setAttribute('onclick', `removeOption('#option-row-${i}')`);
            $(`#option-row-${i} #import_amount_1`).attr('id', `import_amount_${i}`);
            $(`#option-row-${i} #import_price_1`).attr('id', `import_price_${i}`);
            $(`#option-row-${i} #sum_price_1`).attr('id', `sum_price_${i}`);
        }
    }
});

//===============Close option ========================
function removeOption(id) {
    $(`${id}`).remove();
}
//====================================================
function getAmount() {
    let id = event.target.id;
    let index = id.slice(id.lastIndexOf('_') + 1);
    console.log(index);
    let amount = parseInt($('#import_amount_' + index).val());
    let price = parseInt($('#import_price_' + index).val());
    if (!price) {
        price = 0;
    }

    if (!amount) {
        amount = 0
    }
    $('#sum_price_' + index).val(amount * price);
    finalPrice();
}

function getPrice() {
    let id = event.target.id;
    let index = id.slice(id.lastIndexOf('_') + 1);
    let amount = parseInt($('#import_amount_' + index).val());
    let price = parseInt($('#import_price_' + index).val());
    if (!amount) {
        amount = 0;
    }

    if (!price) {
        price = 0;
    }
    $('#sum_price_' + index).val(amount * price);
    finalPrice();
}

function finalPrice() {
    let finalPrice = 0;
    let sumPrices = document.querySelectorAll('.sum_price');
    for (i = 0; i < sumPrices.length; i++) {
        let price = sumPrices[i].value ? parseInt(sumPrices[i].value) : 0;
        finalPrice += price;
    }

    $('.final_price').html(`Tông tiền: ${finalPrice.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' })}`);
}