function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');

    Swal.fire({
        title: 'Are you sure?',
        text: "Delete this data !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function(data) {
                    Swal.fire(
                        'Deleted!',
                        'Record has been deleted.',
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