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

        <!-- Card Row -->
        <div class="row justify-content-center">

            <!-- All Customer -->
            <div class="col-xl-3 col-md-5 mb-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Customer</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_customer; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <!-- <hr> -->
                    <div class="text-center">
                        <a href="#cardCustomer" class="stretched-link anchor-link" title="<?= $total_customer; ?> Customers"></a>
                    </div>
                </div>
            </div>

            <!-- Work Order Request -->
            <div class="col-xl-3 col-md-5 mb-3">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Work Order</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= !empty($work_order) ? count($work_order) . ' Request' : "0"; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <!-- <hr> -->
                    <div class="text-center">
                        <a href="<?= base_url('manager/konstruksi/workorder'); ?>" <?= !empty($work_order) ? 'class="stretched-link"  title="' . count($work_order) . ' Request"' : 'class="stretched-link" style="cursor: default;" title="No Work Order Request"' ?>>
                            <!-- View More
                            <span>
                                <i class="far fa-arrow-alt-circle-right"></i>
                            </span> -->
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pending Report Log Approval -->
            <div class="col-xl-3 col-md-5 mb-3">
                <div class="card border-left-cadetblue shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-cadetblue text-uppercase mb-1">Report Log Approval</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= !empty($report_log) ? count($report_log) . ' Reports' : "0"; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="<?= !empty($report_log) ? "#cardReports" : "#" ?>" <?= !empty($report_log) ? 'class="stretched-link anchor-link"  title="' . count($report_log) . ' Reports waiting for approval"' : 'class="stretched-link anchor-link" style="cursor: default;" title="No Reports Received"' ?>>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pending Problem Report Log Approval -->
            <div class="col-xl-3 col-md-5 mb-3">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Problem Report</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= !empty($problem_report) ? count($problem_report) . ' Reports' : count($problem_report); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <!-- <hr> -->
                    <div class="text-center">
                        <a href="<?= !empty($problem_report) ? base_url('manager/konstruksi/problem-report') : "#" ?>" <?= !empty($problem_report) ? 'class="stretched-link"' : 'class="stretched-link" style="cursor: default;" title="No Problem Reports Received"' ?>>
                            <!-- View More
                            <span>
                                <i class="far fa-arrow-alt-circle-right"></i>
                            </span> -->
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Row 2 -->
        <div class="row justify-content-center mb-0 ">
            <!-- On Construction -->
            <div class="col-xl-3 col-md-5 mb-3 d-md-block d-none">
                <div class="card border-left-orange shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-orange text-uppercase mb-1">On Construction</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_construction; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tools fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <!-- <hr> -->
                    <div class="text-center">
                        <span class="stretched-link disabled" <?= ($total_construction > 0) ? 'title="' . $total_construction . ' Customer on Construction"' : 'title="No Problem Reports Received"' ?> style="cursor: default;">
                    </div>
                </div>
            </div>
            <!-- Energizing -->
            <div class="col-xl-3 col-md-5 mb-3 d-md-block d-none">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Energizing / Finished</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_energize; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bolt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <!-- <hr> -->
                    <div class="text-center">
                        <span class="stretched-link disabled" <?= ($total_energize > 0) ? 'title="' . $total_energize . ' Customer has been Energizing / Finished"' : 'title="No Problem Reports Received"' ?> style="cursor: default;">
                            <!-- View More
                            <span>
                                <i class="far fa-arrow-alt-circle-right"></i>
                            </span> -->
                        </span>
                    </div>
                </div>
            </div>
            <!-- Terminated -->
            <div class="col-xl-3 col-md-5 mb-3 d-md-block d-none">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Terminated</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_terminated; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-times fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <!-- <hr> -->
                    <div class="text-center">
                        <span <?= ($total_terminated > 0) ? 'class="stretched-link" style="cursor: default;" title="' . $total_terminated . ' Customer Terminated"' : 'class="stretched-link" style="cursor: default;" title="There\'s no terminated Customer"' ?>>
                            <!-- View More
                            <span>
                                <i class="far fa-arrow-alt-circle-right"></i>
                            </span> -->
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Row 3 -->
        <div class="row">
            <!-- List SuperVisor -->
            <div class="col-lg-4 mt-2 mb-2">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Supervisor</h6>
                    </div>
                    <div class="card-body" style="max-height: 370px; overflow-y: auto;">
                        <?php foreach ($list_spv as $spv) : ?>
                            <?php if (!is_null($spv['name_customer'])) : ?>
                                <span class="float-right text-orange small font-weight-bolder animate__animated animate__flash animate__infinite animate__slower" title="On Construction <i>(<?= $spv['name_customer']; ?>)</i>" data-html='true'>On Construction</span>
                            <?php else : ?>
                                <span class="float-right text-primary small font-weight-bolder" title="Available for Construction">Free</span>
                            <?php endif; ?>
                            <div class="row mb-4">
                                <div class="">
                                    <?php if ($spv['image'] == 'default.jpg') { ?>
                                        <img class="img-fluid rounded-circle" src="<?= base_url('assets/img/profile/' . $spv['image']); ?>" width="35" height="35">
                                    <?php } else { ?>
                                        <img class="img-fluid rounded-circle" src="<?= base_url('assets/img/profile/' . $spv['id_user'] . '/' . $spv['image']); ?>" width="35" height="35">
                                    <?php } ?>
                                </div>
                                <div class="col">
                                    <div class="list-heading">
                                        <span class="ml-1 small font-weight-bold"><?= $spv['name']; ?> </span>
                                    </div>
                                    <div class="list-subheading">
                                        <span class="ml-1 text-gray-500 small"><?= $spv['role_type']; ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mt-2 mb-2">
                <!-- Reports Waiting For Approval -->
                <div class="card shadow" id="cardReports">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Reports (Waiting for Approval) <span class="badge badge-danger font-weight-lighter"><?= count($report_log); ?></span></h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-all-report" style="width: 100%;">
                            <thead class="">
                                <tr class="text-center">
                                    <!-- <th scope="col">#</th> -->
                                    <th scope="col">Supervisor</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Date & Time</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($report_log as $c) : ?>
                                    <tr class="table-light">
                                        <td><?= $c['name']; ?></td>
                                        <td><?= excerpt($c['description'], NULL, 40); ?></td>
                                        <td class="text-center"><i class="fas fa-fw fa-calendar-alt"></i><?= localizedDateString($c['date_report']); ?><br><?= localizedTimeString($c['start_time']); ?> - <?= localizedTimeString($c['end_time']); ?></td>
                                        <td class="text-center">
                                            <!-- Button View Report -->
                                            <div class="tooltip-wrapper mb-1" data-toggle="tooltip" data-placement="left" data-original-title="View Report">
                                                <a href="#" id="viewReportLog" class="btn btn-sm btn-primary btn-view-report" data-toggle="modal" data-target="#modalReport" data-id="<?= $c['id_user_report']; ?>" data-url="<?= base_url('construction/report'); ?>" data-baseurl="<?= base_url(); ?>"><i class="fas fa-fw fa-eye"></i></a>
                                            </div>
                                            <!-- Button Approve Report Log -->
                                            <div class="tooltip-wrapper mb-1" data-toggle="tooltip" data-placement="left" data-original-title="#">
                                                <a href="#" id="approveReportLog" class="btn btn-sm btn-success btn-approve-log" data-url="<?= base_url('manager'); ?>" data-id="<?= $c['id_user_report']; ?>" data-information="<?= $c['approval_status']; ?>"><i class="fas fa-fw fa-check"></i></a>
                                            </div>
                                            <!-- Button Reject Report Log -->
                                            <div class="tooltip-wrapper" data-toggle="tooltip" data-placement="left" data-original-title="#">
                                                <a href="#" id="rejectReportLog" class="btn btn-sm btn-danger btn-reject-log" data-url="<?= base_url('manager'); ?>" data-id="<?= $c['id_user_report']; ?>" data-information="<?= $c['approval_status']; ?>"><i class="fas fa-fw fa-times"></i></a>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- Table Customer (Construction) -->
        <div class="row">
            <div class="col mt-3">
                <div class="card shadow" id="cardCustomer">
                    <div class="card-header py-3">
                        <!-- <h5 class="">List Customer</h5> -->
                        <h6 class="m-0 text-primary font-weight-bold">Customer (On Construction)</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-construction-customer" style="width: 100%;">
                            <thead class="">
                                <tr class="text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tarif / Daya</th>
                                    <th scope="col">Layanan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Informasi</th>
                                    <th scope="col">Pengawas</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($information as $c) : ?>
                                    <tr class="table-light">
                                        <th scope="row" class="text-center"><?= $i; ?></th>
                                        <td><?= $c['name_customer']; ?></td>
                                        <td class="text-center"><?= $c['id_pelanggan'] ?? "Not Defined"; ?></td>
                                        <td class="text-center"><?= $c['tariff']; ?> / <?= $c['power']; ?></td>
                                        <td class="text-center">
                                            <span class="badge <?= $c['badge']; ?>">
                                                <?= $c['type_of_service']; ?>
                                            </span>
                                        </td>
                                        <td class="text-center"><?= $c['status']; ?></td>
                                        <td class="text-center"><?= $c['information']; ?></td>
                                        <td class="text-center"><?= $c['name'] ?? '-'; ?></td>
                                        <td class="text-center">
                                            <form action="<?= base_url('manager/konstruksi/detail/' . $c['id_customer']); ?>" method="post">
                                                <?= csrf_field(); ?>
                                                <button type="submit" class="btn btn-sm btn-primary btn-work-order" data-toggle="tooltip" data-placement="bottom" data-id="<?= $c['id_customer']; ?>" data-url="<?= base_url('manager/'); ?>" data-information="<?= $c['information']; ?>" title="See Detail Info <?= $c['name_customer']; ?>"><i class="fas fa-fw fa-edit"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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

<!-- Modal View Report -->
<div class="modal fade" id="modalReport">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="projectAsel" class="carousel slide project-slide" data-interval="false">
                    <div class="carousel-inner">
                        <div id="carousel-item-image">
                        </div>
                        <ol class="carousel-indicators">
                        </ol>
                    </div>
                    <a class="carousel-control-prev" href="#projectAsel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#projectAsel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- <div id="carouselHeader">
                    <h3>Project A</h3>
                </div> -->
                <div id="info" class="pt-3">
                    <table class="table table-borderless table-responsive-sm">
                        <tbody>
                            <tr>
                                <th>Date</th>
                                <th>:</th>
                                <td id="data-date"></td>
                            </tr>
                            <tr>
                                <th>Time</th>
                                <th>:</th>
                                <td id="data-time"></td>
                            </tr>
                            <tr>
                                <th>User</th>
                                <th>:</th>
                                <td id="data-user"></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <th>:</th>
                                <td id="data-status"></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <th>:</th>
                                <td id="data-description"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.table-construction-customer').dataTable({
            'destroy': true,
            'responsive': true,
            "pageLength": -1,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            'scrollY': '240px',
            'scrollX': true,
            'scrollCollapse': true,
            'fixedColumns': true,
            'order': [
                [2, "asc"]
            ],
            'columnDefs': [{
                'targets': [0],
                'searchable': false,
                'orderable': false
            }, {
                'targets': 3,
                'width': '120px'
            }, {
                'targets': 6,
                'width': "161px"
            }],
        });

        $('.table-all-report').dataTable({
            'destroy': true,
            'dom': 'frt<"text-center"i>',
            'responsive': true,
            "pageLength": -1,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            'scrollY': '200px',
            'scrollX': true,
            'scrollCollapse': true,
            'fixedColumns': true,
            'order': [
                [2, "desc"]
            ],
            'columnDefs': [{
                'targets': [2],
                'width': '110px',
            }, {
                'targets': [3],
                'width': '100px',
            }, ]

        });
    });
</script>
<?= $this->endSection(); ?>