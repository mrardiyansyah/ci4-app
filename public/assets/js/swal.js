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

// Button Delete Customer
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

// Submit Form Rejuvenate
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

// Submit Form Cancellation
$(document).on('submit', '#form-cancellation', function (e) {
    e.preventDefault();
    Swal.fire({
        title: false,
        html: `Are you sure want to save this changes? This action cannot be undo. Make sure you want to do this.`,
        icon: 'warning',
        padding: '1em',
        width: 400,
        showCancelButton: true,
        cancelButtonText: `No, I'm not sure`,
        confirmButtonText: 'Yes, sure',
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
            // console.log($(this));
            $(this)[0].submit();
        }
    });
});

// Button Confirm CLosing
$(document).on('click', '.btn-confirm-closing', function (e) {
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: false,
        html: `Are you sure want to save this changes? This action cannot be undo. Make sure you want to do this.`,
        icon: 'warning',
        padding: '1em',
        width: 400,
        showCancelButton: true,
        cancelButtonText: `No, I'm not sure`,
        confirmButtonText: 'Yes, go to Closing!',
        buttonsStyling: false,
        showClass: {
            popup: 'animate__animated animate__fadeInDown animate__fast',
            icon: 'animate__animated animate__fadeIn animate__delay-1s animate__repeat-3'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        customClass: {
            confirmButton: 'btn btn-warning btn-sm font-small',
            cancelButton: 'btn btn-secondary btn-sm ml-3 font-small',
        }
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});

// Button Confirm Cancellation
$(document).on('click', '.btn-confirm-cancellation', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: false,
        html: `Are you sure want to save this changes? This action cannot be undo. Make sure you want to do this.`,
        icon: 'warning',
        padding: '1em',
        width: 400,
        showCancelButton: true,
        cancelButtonText: `No, I'm not sure`,
        confirmButtonText: 'Yes, Go to Cancellation!',
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

// Button Confirm Cancellation
$(document).on('click', '.btn-submit-reksis', function (e) {

    e.preventDefault();
    const info = $(this).data('information');
    if (info == "Menunggu Reksis") {
        let url = $(this).data('url');
        let id_customer = $(this).data('id');
        const form_reksis = $(this).parent()

        const href = url + '/process/' + id_customer;

        Swal.fire({
            title: false,
            html: `Are you sure you want to continue processing system recommendations?`,
            icon: 'question',
            padding: '1em',
            width: 400,
            showCancelButton: true,
            cancelButtonText: `Cancel`,
            confirmButtonText: 'Yes, I\'m sure',
            buttonsStyling: false,
            showClass: {
                popup: 'animate__animated animate__fadeInDown animate__fast',
                icon: 'animate__animated animate__fadeIn animate__delay-1s animate__repeat-3'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            },
            customClass: {
                confirmButton: 'btn btn-info btn-sm font-small',
                cancelButton: 'btn btn-secondary btn-sm ml-3 font-small',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // document.location.href = href;
                $.ajax({
                    type: "POST",
                    url: href,
                    dataType: "JSON",
                    success: function (response) {
                        var result = JSON.parse(JSON.stringify(response));
                        if (result.success === "success") {
                            Swal.fire({
                                title: 'Information Updated!',
                                icon: 'success',
                                html: 'Reksis and SLD on Process. Please upload',
                                showCloseButton: false,
                                showCancelButton: false,
                                timer: 1000,
                            }).then((response) => {
                                if (response.dismiss === Swal.DismissReason.timer) {
                                    form_reksis.submit();
                                }
                            });
                        } else {
                            Swal.fire('Failed', result.error.message, 'error');
                        }
                    }
                });
            }
        });
    } else {
        $(this).parent().submit();
    }
});

// Button Confirm Cancellation
$(document).on('click', '.btn-submit-construct', function (e) {

    e.preventDefault();
    const form_reksis = $(this).closest("form");
    let id_customer = $(this).data('id');

    const href = form_reksis.attr("action") + "/start/" + id_customer;

    // console.log(form_reksis);
    // alert(href);
    // alert(id_customer);
    // alert(href);
    Swal.fire({
        title: false,
        html: `Are you sure you want to <b>Start Construct</b>? This action will update the status and cannot be undo.`,
        icon: 'question',
        padding: '1em',
        width: 400,
        showCancelButton: true,
        cancelButtonText: `Cancel`,
        confirmButtonText: 'Yes, I\'m sure',
        buttonsStyling: false,
        showClass: {
            popup: 'animate__animated animate__fadeInDown animate__fast',
            icon: 'animate__animated animate__fadeIn animate__delay-1s animate__repeat-3'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        customClass: {
            confirmButton: 'btn btn-info btn-sm font-small',
            cancelButton: 'btn btn-secondary btn-sm ml-3 font-small',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // document.location.href = href;
            $.ajax({
                type: "POST",
                url: href,
                dataType: "JSON",
                success: function (response) {
                    var result = JSON.parse(JSON.stringify(response));
                    if (result.success === "success") {
                        Swal.fire({
                            title: 'Information Updated!',
                            icon: 'success',
                            html: 'Reksis and SLD on Process. Please upload',
                            showCloseButton: false,
                            showCancelButton: false,
                            timer: 1000,
                        }).then((response) => {
                            if (response.dismiss === Swal.DismissReason.timer || response.value === true) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire('Failed', result.error.message, 'error');
                    }
                }
            });
        }
    });
});

// Button Approve Log
$(document).on('click', '.btn-approve-log#approveReportLog', function (e) {

    e.preventDefault();

    let url = $(this).data('url');
    let id_user_report = $(this).data('id');
    const form_reksis = $(this).parent()

    const href = url + '/approve';

    Swal.fire({
        title: false,
        html: `Are you sure you want to approve this report? This action can't be undo`,
        icon: 'question',
        padding: '1em',
        width: 400,
        showCancelButton: true,
        cancelButtonText: `Cancel`,
        confirmButtonText: 'Yes, I\'m sure',
        buttonsStyling: false,
        showClass: {
            popup: 'animate__animated animate__fadeInDown animate__fast',
            icon: 'animate__animated animate__fadeIn animate__delay-1s animate__repeat-3'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        customClass: {
            confirmButton: 'btn btn-info btn-sm font-small',
            cancelButton: 'btn btn-secondary btn-sm ml-3 font-small',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // document.location.href = href;
            $.ajax({
                type: "POST",
                url: href,
                dataType: "JSON",
                data: {
                    id_user_report: id_user_report
                },
                success: function (response) {
                    var result = JSON.parse(JSON.stringify(response));
                    console.log(response);
                    if (result.success === "success") {
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            html: 'Report approved! ',
                            showCloseButton: false,
                            showCancelButton: false,
                            timer: 800,
                        }).then((response) => {
                            if (response.dismiss === Swal.DismissReason.timer) {
                                form_reksis.submit();
                                window.location.reload();
                            }
                        });
                    } else {
                        console.log(response);
                        Swal.fire('Failed', result.error.message, 'error');
                    }
                }
            });
        }
    });
});

$(document).on('click', '.btn-reject-log#rejectReportLog', function (e) {

    e.preventDefault();

    let url = $(this).data('url');
    let id_user_report = $(this).data('id');
    const form_reksis = $(this).parent()

    const href = url + '/reject';

    Swal.fire({
        title: false,
        html: `Are you sure you want to reject this report? This action can't be undo`,
        icon: 'question',
        padding: '1em',
        width: 400,
        showCancelButton: true,
        cancelButtonText: `Cancel`,
        confirmButtonText: 'Yes, I\'m sure',
        buttonsStyling: false,
        showClass: {
            popup: 'animate__animated animate__fadeInDown animate__fast',
            icon: 'animate__animated animate__fadeIn animate__delay-1s animate__repeat-3'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        customClass: {
            confirmButton: 'btn btn-info btn-sm font-small',
            cancelButton: 'btn btn-secondary btn-sm ml-3 font-small',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // document.location.href = href;
            $.ajax({
                type: "POST",
                url: href,
                dataType: "JSON",
                data: {
                    id_user_report: id_user_report
                },
                success: function (response) {
                    var result = JSON.parse(JSON.stringify(response));
                    console.log(response);
                    if (result.success === "success") {
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            html: 'Report rejected! ',
                            showCloseButton: false,
                            showCancelButton: false,
                            timer: 800,
                        }).then((response) => {
                            if (response.dismiss === Swal.DismissReason.timer) {
                                form_reksis.submit();
                                window.location.reload();
                            }
                        });
                    } else {
                        console.log(response);
                        Swal.fire('Failed', result.error.message, 'error');
                    }
                }
            });
        }
    });
});

// Button Approve Problem Report Log
$(document).on('click', '.btn-approve-log#approveProblemReport', function (e) {
    e.preventDefault();
    let url = $(this).data('url');
    let id_user_report = $(this).data('id');
    const form_reksis = $(this).parent()

    const href = url + '/approve';

    Swal.fire({
        title: false,
        html: `Are you sure you want to approve this report? This report will be sent to marketing for confirmation`,
        icon: 'question',
        padding: '1em',
        width: 400,
        showCancelButton: true,
        cancelButtonText: `Cancel`,
        confirmButtonText: 'Yes, I\'m sure',
        buttonsStyling: false,
        showClass: {
            popup: 'animate__animated animate__fadeInDown animate__fast',
            icon: 'animate__animated animate__fadeIn animate__delay-1s animate__repeat-3'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        customClass: {
            confirmButton: 'btn btn-info btn-sm font-small',
            cancelButton: 'btn btn-secondary btn-sm ml-3 font-small',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // document.location.href = href;
            $.ajax({
                type: "POST",
                url: href,
                dataType: "JSON",
                data: {
                    id_user_report: id_user_report
                },
                success: function (response) {
                    var result = JSON.parse(JSON.stringify(response));
                    console.log(response);
                    if (result.success === "success") {
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            html: 'Report approved! ',
                            showCloseButton: false,
                            showCancelButton: false,
                            timer: 800,
                        }).then((response) => {
                            if (response.dismiss === Swal.DismissReason.timer) {
                                form_reksis.submit();
                                window.location.reload();
                            }
                        });
                    } else {
                        console.log(response);
                        Swal.fire('Failed', result.error.message, 'error');
                    }
                }
            });
        }
    });
});

$(document).on('click', '.btn-reject-log#rejectProblemReport', function (e) {

    e.preventDefault();

    let url = $(this).data('url');
    let id_user_report = $(this).data('id');
    const form_reksis = $(this).parent()

    const href = url + '/problem-solve/' + id_user_report;

    Swal.fire({
        title: false,
        html: `Are you sure you want to reject this report? This action can't be undo`,
        icon: 'warning',
        padding: '1em',
        width: 400,
        showCancelButton: true,
        cancelButtonText: `Cancel`,
        confirmButtonText: 'Yes, I\'m sure',
        buttonsStyling: false,
        showClass: {
            popup: 'animate__animated animate__fadeInDown animate__fast',
            icon: 'animate__animated animate__fadeIn animate__delay-1s animate__repeat-3'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        customClass: {
            confirmButton: 'btn btn-warning btn-sm font-small',
            cancelButton: 'btn btn-secondary btn-sm ml-3 font-small',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    });
});