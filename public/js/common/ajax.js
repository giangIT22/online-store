function doAjax(url, type, data, funtionName) {

    var url = doAjax_params['url'];
    var requestType = doAjax_params['requestType'];
    var data = doAjax_params['data'];

    $.ajax({
        url: url,
        type: requestType,
        data: data,
        success: function(response) {
            functionName(response);
        },
    });
}