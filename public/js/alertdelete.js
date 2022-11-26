function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');

    Swal.fire({
        title: 'Bạn có muốn xóa không',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: "Hủy bỏ",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function(data) {
                    Swal.fire(
                        'Xóa thành công',
                        'success'
                    ).then(function(isConfirm) {
                        if (isConfirm) {
                            location.reload();
                        }
                    });
                }
            })
        }
    })
}

$(() => {
    $(document).on('click', '.action-delete', actionDelete);
});