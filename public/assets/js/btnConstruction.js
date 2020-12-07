$(document).ready(function () {
    // Button Edit Log
    $('a.btn-edit-log').each(function (index, element) {
        let information = $(this).data('information');
        // let name_customer = $(this).data('cust');
        switch (information) {
            case 'Waiting for Approval':
                $(this).parent().attr("data-original-title", "Edit Log");
                break;

            case 'Approved':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                $(this).parent().addClass("disabled");
                $(this).parent().attr("data-original-title", "Can't Edit Approved Log");
                break;

            case 'Not Approved':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                $(this).parent().addClass("disabled");
                $(this).parent().attr("data-original-title", "Can't Edit Not Approved Log");
                break;

            case 'Forwarding to the Marketing':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                $(this).parent().addClass("disabled");
                $(this).parent().attr("data-original-title", "Can't Edit Not Approved Log");
                break;

            case 'Problem Solved':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                $(this).parent().addClass("disabled");
                $(this).parent().attr("data-original-title", "Can't Edit Not Approved Log");
                break;

            default:
                $(this).parent().attr("data-original-title", "");
                break;
        }
    });

    $('a.btn-edit-log#editReportLog').on('click', function (e) {
        e.preventDefault();
        const url = $(this).data('url');
        const id_user_report = $(this).data('id');

        let href = url + '/edit-log-form/' + id_user_report;
        window.location.href = href
    });

    $('a.btn-edit-log#editProblemLog').on('click', function (e) {
        e.preventDefault();
        const url = $(this).data('url');
        const id_user_report = $(this).data('id');

        let href = url + '/edit-problem-log/' + id_user_report;
        window.location.href = href
    });

    // Button Delete Log
    $('button.btn-delete-log').each(function (index, element) {
        let information = $(this).data('information');
        let tooltip_wrapper = $(this).parent().parent();
        // let name_customer = $(this).data('cust');
        switch (information) {
            case 'Waiting for Approval':
                tooltip_wrapper.attr("data-original-title", "Delete Log");
                break;

            case 'Approved':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                tooltip_wrapper.addClass("disabled");
                tooltip_wrapper.attr("data-original-title", "Can't Delete Approved Log");
                break;

            case 'Not Approved':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                tooltip_wrapper.addClass("disabled");
                tooltip_wrapper.attr("data-original-title", "Can't Delete Not Approved Log");
                break;

            case 'Forwarding to the Marketing':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                tooltip_wrapper.addClass("disabled");
                tooltip_wrapper.attr("data-original-title", "Can't Delete Not Approved Log");
                break;

            case 'Problem Solved':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                tooltip_wrapper.addClass("disabled");
                tooltip_wrapper.attr("data-original-title", "Can't Delete Not Approved Log");
                break;



            default:
                tooltip_wrapper.attr("data-original-title", "Delete Log");
                break;
        }
    });

    $('.btn-delete-log#deleteReportLog').on('click', function (e) {
        e.preventDefault();
        const url = $(this).data('url');
        const id_user_report = $(this).data('id');
        const information = $(this).data('information');
        let form_delete = $(this).closest("form")

        switch (information) {
            case 'Waiting for Approval':
                let href = url + '/delete-log/' + id_user_report;
                form_delete.attr('action', href);
                Swal.fire({
                    title: false,
                    html: `Are you sure want to delete this log? This action cannot be undo.`,
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
                        form_delete.submit();
                    }
                });
                break;

            default:
                form_delete.attr('action', '#');
                break;
        }

        // console.log(form_delete);

    });

    $('.btn-delete-log#deleteProblemLog').on('click', function (e) {
        e.preventDefault();
        const url = $(this).data('url');
        const id_user_report = $(this).data('id');
        const information = $(this).data('information');
        let form_delete = $(this).closest("form")
        // console.log(form_delete);
        // console.log(url);
        // console.log(id_user_report);
        // console.log(information);

        switch (information) {
            case 'Waiting for Approval':
                let href = url + '/delete-problem-log/' + id_user_report;
                form_delete.attr('action', href);
                Swal.fire({
                    title: false,
                    html: `Are you sure want to delete this log? This action cannot be undo.`,
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
                        form_delete.submit();
                    }
                });
                break;

            default:
                form_delete.attr('action', '#');
                break;
        }
    });
});