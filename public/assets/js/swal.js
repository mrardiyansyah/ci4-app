const swal = $('.swal').data('swal');
// if (swal) {
//     swal.fire({
//         title: 'Data oke',
//         text: swal,
//         icon: 'success'
//     });
// }
$(document).on('click', '#delete-menu', function (e) {
    e.preventDefault();
    const href = $(this).attr('href');
    let menu = $(this).data('menu');

    Swal.fire({
        title: false,
        html: `Are you sure want to delete '<strong>${menu}</strong>'? This action cannot be undo.`,
        icon: 'warning',
        padding: '1em',
        width: 400,
        showCancelButton: true,
        cancelButtonText: `Cancel`,
        confirmButtonText: 'Delete',
        buttonsStyling: false,
        showClass: {
            popup: 'animate__animated animate__fadeInDown animate__fast',
            icon: 'animate__animated animate__fadeIn animate__delay-1s animate__repeat-3'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        customClass: {
            confirmButton: 'btn btn-danger btn-sm font-small',
            cancelButton: 'btn btn-secondary btn-sm ml-3 font-small',
        }
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});