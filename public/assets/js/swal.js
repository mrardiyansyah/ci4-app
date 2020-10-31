// THIS FILE CUSTOM SWAL JS FOR PREVENTING ACTION 

const swal = $('.swal').data('swal');
// if (swal) {
//     swal.fire({
//         title: 'Data oke',
//         text: swal,
//         icon: 'success'
//     });
// }

// DELETE MENU BUTTON
$(document).on('click', '#delete-menu', function (e) {
    e.preventDefault();
    // const action_link = $("#form-delete-role").attr('action');
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

// DELETE SUB MENU BUTTON
$(document).on('click', '.btn-delete-submenu', function (e) {
    e.preventDefault();
    let submenu = $(this).data('submenu');

    Swal.fire({
        title: false,
        html: `Are you sure want to delete '<strong>${submenu}</strong>'? This action cannot be undo.`,
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
            $(this).parent().submit();
        }
    });
});

// DELETE ROLE BUTTON
$(document).on('click', '.btn-delete-role', function (e) {
    e.preventDefault();
    let role = $(this).data('role');

    Swal.fire({
        title: false,
        html: `Are you sure want to delete '<strong>${role}</strong>'? This action cannot be undo.`,
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
            $(this).parent().submit();
        }
    });
});

$(document).on('click', '#btn-delete-customer', function (e) {
    e.preventDefault();
    let name_customer = $(this).data('customer');

    Swal.fire({
        title: false,
        html: `Are you sure want to delete customer '<strong>${name_customer}</strong>'? This action cannot be undo. Make sure you want to do this.`,
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
            $(this).parent().submit();
        }
    });
});

$(document).on('submit', '#form-rejuvenate', function (e) {
    e.preventDefault();
    Swal.fire({
        title: false,
        html: `Are you sure want to save this changes? This action cannot be undo. Make sure you want to do this.`,
        icon: 'warning',
        padding: '1em',
        width: 400,
        showCancelButton: true,
        cancelButtonText: `Cancel`,
        confirmButtonText: 'Save',
        buttonsStyling: false,
        showClass: {
            popup: 'animate__animated animate__fadeInDown animate__fast',
            icon: 'animate__animated animate__fadeIn animate__delay-1s animate__repeat-3'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        customClass: {
            confirmButton: 'btn btn-primary btn-sm font-small',
            cancelButton: 'btn btn-secondary btn-sm ml-3 font-small',
        }
    }).then((result) => {
        if (result.value) {
            // console.log($(this));
            $(this)[0].submit();
        }
    });
});
// $(document).on('click', '.btn-rejuvenation', function (e) {
//     e.preventDefault();
//     Swal.fire({
//         title: false,
//         html: `Are you sure want to save this changes? This action cannot be undo. Make sure you want to do this.`,
//         icon: 'warning',
//         padding: '1em',
//         width: 400,
//         showCancelButton: true,
//         cancelButtonText: `Cancel`,
//         confirmButtonText: 'Save',
//         buttonsStyling: false,
//         showClass: {
//             popup: 'animate__animated animate__fadeInDown animate__fast',
//             icon: 'animate__animated animate__fadeIn animate__delay-1s animate__repeat-3'
//         },
//         hideClass: {
//             popup: 'animate__animated animate__fadeOutUp'
//         },
//         customClass: {
//             confirmButton: 'btn btn-primary btn-sm font-small',
//             cancelButton: 'btn btn-secondary btn-sm ml-3 font-small',
//         }
//     }).then((result) => {
//         if (result.value) {
//             $("#form-rejuvenate").submit();
//         }
//     });
// });