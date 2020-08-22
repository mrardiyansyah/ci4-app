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

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

    <!-- Custom Data Tables for this template -->
    <link href="<?= base_url('assets/css/set2.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/lpremium.css'); ?>" rel="stylesheet">

    <!-- Dropzone JS -->
    <link href="<?= base_url('assets/css/dropzone.css'); ?>" rel="stylesheet">
    <script src="<?= base_url('assets/js/dropzone.js'); ?>"></script>

    <!-- Mdbootstrap style -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/animate.css/animate.css'); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" />
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>


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
        <i class="fas fa-angle-up"></i>
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

    <!-- Bootstrap core JavaScript-->

    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

    <!-- Custom scripts for Popper -->
    <script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>

    <script src="<?= base_url('assets/js/classie.js'); ?>"></script>

    <script src="<?= base_url('assets/js/pln_premium.js'); ?>"></script>
    <script src="<?= base_url('assets/js/swal.js'); ?>"></script>



    <script>
        $('.form-check-input').on('click', function() {
            const menuId = $(this).data('menu');
            const roleId = $(this).data('role');

            $.ajax({
                url: "<?= base_url('admin/changeaccess'); ?>",
                type: 'post',
                data: {
                    // Objek Data: Variable yang sudah diambil
                    menuId: menuId,
                    roleId: roleId
                },
                success: function() {
                    document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
                }
            });
        });


        // if (status === 'Not Yet') {

        // } else if (status === 'Problem Mapping') {



        $('.btnNext').click(function() {
            $('.nav-pills > .nav-item > .active').parent().next('li').find('a').trigger('click');
        });

        $('.btnPrevious').click(function() {
            $('.nav-pills > .nav-item > .active').parent().prev('li').find('a').trigger('click');
        });

        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            let numFiles = $("input:file")[0].files.length;

            if (numFiles > 1) {
                $(this).next('.custom-file-label').addClass("selected alert-info").removeClass("alert-danger").html(numFiles + " Files selected");
            } else if (numFiles == 1) {
                $(this).next('.custom-file-label').addClass("selected alert-info").removeClass("alert-danger").html(fileName);
            } else {
                $(this).next('.custom-file-label').addClass("selected alert-danger").html('No File Selected');
            }

        });

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

        $(document).ready(function() {
            $("#confirm-submit-probing").click(function() {
                $("#addProblemMapping").submit();
            });
        });

        $(document).ready(function() {
            $("#confirm-submit-visit-ae").click(function() {
                $("#addKunjungan").submit();
            });
        });

        $(document).ready(function() {
            $("#confirm-submit-cancel").click(function() {
                $("#addCancellation").submit();
            });
        });

        $(document).ready(function() {
            $("#confirm-submit-cancel-cons").click(function() {
                $("#addCancellationCons").submit();
            });
        });

        $(document).ready(function() {
            $("#confirm-submit-cons").click(function() {
                $("#uploadReportCons").submit();
            });
        });

        $(document).ready(function() {
            $("#input-potential-file").click(function() {
                $("#inputPotentialExcel").submit();
                // alert('asu');
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