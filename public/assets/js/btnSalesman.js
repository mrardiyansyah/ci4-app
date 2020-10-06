$(document).ready(function () {
    $(".form-cust-sales").submit(function (e) {
        e.preventDefault();

        $(this).trigger('reset');
        const url = $(this).children('.btn-cust-sales').data('url');
        let id_customer = $(this).children('.btn-cust-sales').data('id');
        let information = $(this).children('.btn-cust-sales').data('information');

        switch (information) {
            case 'Not Yet':
                // console.log($(this).attr("action", url + '/rejuvenation/' + id_customer));
                $(this).attr("action", url + '/rejuvenate/' + id_customer);
                return $(this)[0].submit();

            case 'Probing':
                $(this).attr("action", url + '/probing/' + id_customer);
                return $(this)[0].submit();

            case 'Menunggu Reksis':
                $(this).attr("action", url + '/rejuvenation/' + id_customer);
                return $(this)[0].submit();

            case 'Proses Reksis':
                $(this).attr("action", url + '/rejuvenation/' + id_customer);
                return $(this)[0].submit();

            case 'Proses SPJBTL':
                $(this).attr("action", url + '/rejuvenation/' + id_customer);
                return $(this)[0].submit();

            case 'WO to Construction':
                $(this).attr("action", url + '/rejuvenation/' + id_customer);
                return $(this)[0].submit();

            case 'Working Order Terbit':
                $(this).attr("action", url + '/rejuvenation/' + id_customer);
                return $(this)[0].submit();

            case 'On Construction':
                $(this).attr("action", url + '/rejuvenation/' + id_customer);
                return $(this)[0].submit();

            case 'Waiting For Confirmation':
                $(this).attr("action", url + '/rejuvenation/' + id_customer);
                $(this).submit();
                break;

            case 'Proses Energizing':
                $(this).attr("action", url + '/rejuvenation/' + id_customer);
                $(this).submit();
                break;

            case 'Finished':
                $(this).attr("action", url + '/rejuvenation/' + id_customer);
                $(this).submit();
                break;

            case 'Cancelled':
                $(this).attr("action", url + '/rejuvenation/' + id_customer);
                $(this).submit();
                break;

            case 'Terminated By Problem':
                $(this).attr("action", url + '/rejuvenation/' + id_customer);
                $(this).submit();
                break;

            default:
                break;
        }

    });
});