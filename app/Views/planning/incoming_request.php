<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    </div>

    <div class="col-lg">
        <div class="col-lg-6">
            <?= session()->get('message'); ?>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-5 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Potential Customer</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">No Incoming Request</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <a href="<?= base_url('planning/request-potential'); ?>" class="stretched-link">
                            View More
                            <span>
                                <i class="far fa-arrow-alt-circle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-5 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Recommendation System (File Reksis)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= !empty($request_reksis) ? count($request_reksis) . ' Incoming Request' : "No Incoming Request"; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <a href="<?= !empty($request_reksis) ? base_url('planning/request-potential') : "#" ?>" <?= !empty($request_reksis) ? 'class="stretched-link"' : 'data-toggle="tooltip" data-placement="bottom" title="No Incoming Request"' ?>>
                            View More
                            <span>
                                <i class="far fa-arrow-alt-circle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <!-- Content Row -->
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>