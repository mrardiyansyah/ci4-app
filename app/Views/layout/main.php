<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('ico/apple-touch-icon.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('ico/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('ico/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?= base_url('ico/site.webmanifest'); ?>">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

    <!-- Custom Data Tables for this template -->
    <link href="<?= base_url('assets/css/set2.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/lpremium.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/modalReport.css'); ?>" rel="stylesheet">

    <!-- Dropzone JS -->
    <link href="<?= base_url('assets/css/dropzone.css'); ?>" rel="stylesheet">
    <script src="<?= base_url('assets/js/dropzone.js'); ?>"></script>

    <!-- Mdbootstrap style -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/animate.css/animate.css'); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" />
    <script src="<?= base_url('assets/js/jquery-3.5.1.min.js'); ?>"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>

    <!-- tail.select Library -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/tail.select-default.min.css'); ?>">

    <!-- Moment JS -->
    <script src="<?= base_url('assets/js/moment-with-locales.min.js'); ?>"></script>

    <!-- Tempus Dominus Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-2JBCbWoMJPH+Uj7Wq5OLub8E5edWHlTM4ar/YJkZh3plwB2INhhOC3eDoqHm1Za/ZOSksrLlURLoyXVdfQXqwg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-PMjWzHVtwxdq7m7GIxBot5vdxUY+5aKP9wpKtvnNBZrVv1srI8tU6xvFMzG8crLNcMj/8Xl/WWmo/oAP/40p1g==" crossorigin="anonymous" />

    <style>
        .custom-line-height {
            line-height: 1.2;
            height: calc(1.5em + .5rem + 2px);
            font-size: .875rem;
        }
    </style>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="<?= base_url('assets/js/notification.js'); ?>"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?= $this->include('layout/sidebar'); ?>

        <!-- Topbar -->
        <?= $this->include('layout/topbar'); ?>

        <!-- Content -->
        <?= $this->renderSection('content'); ?>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; PLN DISJAYA <?= date('Y'); ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-fw fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Custom scripts for Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/classie.js'); ?>"></script>

    <script src="<?= base_url('assets/js/pln_premium.js'); ?>"></script>
    <script src="<?= base_url('assets/js/swal.js'); ?>"></script>

    <!-- Pusher -->
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;

        var pusher = new Pusher('df1a99135b646cb1942a', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            // alert(JSON.stringify(data));
            $("#counter-notif").hide().load(location.href + " #counter-notif").fadeIn('1000');
            $("#list-notification").hide().load(location.href + " #list-notification").fadeIn('1000');

        });
    </script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#detailReportModal').on('show.bs.modal', function(e) {
                const rowid = $(e.relatedTarget).data('id');

                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'post',
                    url: '<?= base_url('user/detailReport'); ?>',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.modal-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#editSubMenuModal').on('show.bs.modal', function(e) {
                const rowIdSubMenu = $(e.relatedTarget).data('id');
                const rowmenu = $(e.relatedTarget).data('currentsubmenu');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'post',
                    url: '<?= base_url('menu/editSubMenu'); ?>',
                    data: {
                        rowidsm: rowIdSubMenu,
                        rowmenu: rowmenu
                    },
                    success: function(data) {
                        $('.modal-data-submenu').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        });


        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>


</body>

</html>