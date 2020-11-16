$(document).ready(function () {
    $('a.btn-salesman').each(function (index, element) {
        let information = $(this).data('information');
        let tooltipWrapper = $(this).parent();
        switch (information) {
            case 'Not Yet':
                $(this).parent().attr("data-original-title", "Rejuvenate Data");
                break;

            case 'Probing':
                $(this).parent().attr("data-original-title", "Make a Report");
                break;
                // $(this).attr("href", url + '/probing/' + id_customer);
                // return $(this)[0].submit();

            case 'Menunggu Reksis':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                $(this).parent().addClass("disabled");
                $(this).parent().attr("data-original-title", "Waiting for Reksis");
                break;

            case 'Proses Reksis':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                $(this).parent().addClass("disabled");
                $(this).parent().attr("data-original-title", "Reksis on Process");
                break;

            case 'Proses SPJBTL':
                $(this).parent().attr("data-original-title", "Upload File SPJBTL");
                break;

            case 'WO to Construction':
                $(this).parent().attr("data-original-title", "Upload Working Order");
                break;

            case 'Working Order Terbit':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                $(this).parent().addClass("disabled");
                $(this).parent().attr("data-original-title", "Waiting for Confirmation Construction");
                break;

            case 'On Construction':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                $(this).parent().addClass("disabled");
                $(this).parent().attr("data-original-title", "");
                break;

            case 'Waiting For Confirmation':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                $(this).parent().addClass("disabled");
                $(this).parent().attr("data-original-title", "");
                break;

            case 'Proses Energizing':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                $(this).parent().addClass("disabled");
                $(this).parent().attr("data-original-title", "");
                break;

            case 'Finished':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                $(this).parent().addClass("disabled");
                $(this).parent().attr("data-original-title", "");
                break;

            case 'Cancelled':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                $(this).parent().addClass("disabled");
                $(this).parent().attr("data-original-title", "");
                break;

            case 'Terminated By Problem':
                $(this).addClass("disabled");
                $(this).prop("aria-disabled", true);
                $(this).parent().addClass("disabled");
                $(this).parent().attr("data-original-title", "");
                break;

            default:
                $(this).parent().attr("data-original-title", "");
                break;
        }
    });

    $(".btn-salesman").on('click', function (e) {
        e.preventDefault();

        const url = $(this).data('url');
        let id_customer = $(this).data('id');
        let information = $(this).data('information');

        switch (information) {
            case 'Not Yet':
                // console.log($(this).attr("href", url + '/rejuvenation/' + id_customer));
                $(this).attr("href", url + '/rejuvenate/' + id_customer)
                return window.location = $(this).attr('href');

            case 'Probing':
                $(this).attr("href", url + '/probing/' + id_customer)
                return window.location = $(this).attr('href');

                // case 'Menunggu Reksis':
                //     $(this).attr("action", url + '/rejuvenation/' + id_customer);
                //     return $(this)[0].submit();

                // case 'Proses Reksis':
                //     $(this).attr("action", url + '/rejuvenation/' + id_customer);
                //     return $(this)[0].submit();

            case 'Proses SPJBTL':
                $(this).attr("href", url + '/spjbtl/' + id_customer);
                return window.location = $(this).attr('href');

            case 'WO to Construction':
                $(this).attr("href", url + '/working-order/' + id_customer);
                return window.location = $(this).attr('href');

                // case 'Working Order Terbit':
                //     $(this).attr("action", url + '/rejuvenation/' + id_customer);
                //     return $(this)[0].submit();

                // case 'On Construction':
                //     $(this).attr("action", url + '/rejuvenation/' + id_customer);
                //     return $(this)[0].submit();

                // case 'Waiting For Confirmation':
                //     $(this).attr("action", url + '/rejuvenation/' + id_customer);
                //     $(this).submit();
                //     break;

                // case 'Proses Energizing':
                //     $(this).attr("action", url + '/rejuvenation/' + id_customer);
                //     $(this).submit();
                //     break;

                // case 'Finished':
                //     $(this).attr("action", url + '/rejuvenation/' + id_customer);
                //     $(this).submit();
                //     break;

                // case 'Cancelled':
                //     $(this).attr("action", url + '/rejuvenation/' + id_customer);
                //     $(this).submit();
                //     break;

                // case 'Terminated By Problem':
                //     $(this).attr("action", url + '/rejuvenation/' + id_customer);
                //     $(this).submit();
                //     break;

                // default:
                //     break;
        }
    });
});