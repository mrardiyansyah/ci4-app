<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <div class="col-lg-6">
                <?= session()->get('message'); ?>
            </div>
            <table class="table table-bordered table-hover table-striped table-problemLog" style="width: 100%;">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">Date and Time</th>
                        <th scope="col">Description</th>
                        <th scope="col">Suggestion Solution</th>
                        <th scope="col">Solution</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($problem_report as $log) : ?>
                        <tr>
                            <td class="text-center"><i class="fas fa-fw fa-calendar-alt"></i><?= localizedDateString($log['date_report']); ?><br><?= localizedTimeString($log['start_time']); ?> - <?= localizedTimeString($log['end_time']); ?></td>
                            <td class="text-center"><?= excerpt($log['description'], NULL, 80); ?></td>
                            <td class="text-center"><?= (!is_null($log['suggestion_solution'])) ? excerpt($log['suggestion_solution'], NULL, 80) : '-'; ?></td>
                            <td class="text-center"><?= (!is_null($log['solutions'])) ? excerpt($log['solutions'], NULL, 80) : '-'; ?></td>
                            <td class="text-center"><span class="badge <?= $log['badge']; ?>"><?= $log['approval_status']; ?></span></td>
                            <td class="text-center">
                                <!-- Button View Report -->
                                <div class="tooltip-wrapper mb-1" data-toggle="tooltip" data-placement="left" data-original-title="View Report">
                                    <a href="#" id="viewReportLog" class="btn btn-sm btn-primary btn-view-problemreport" data-toggle="modal" data-target="#modalReport" data-id="<?= $log['id_user_cancellation']; ?>" data-url="<?= base_url('manager/problem-report'); ?>" data-baseurl="<?= base_url(); ?>"><i class="fas fa-fw fa-eye"></i></a>
                                </div>
                                <!-- Button Approve Report Log -->
                                <div class="tooltip-wrapper mb-1" data-toggle="tooltip" data-placement="left" data-original-title="#">
                                    <a href="#" id="approveProblemReport" class="btn btn-sm btn-success btn-approve-log" data-user="<?= $role['id_role']; ?>" data-url="<?= base_url('manager'); ?>" data-id="<?= $log['id_user_cancellation']; ?>" data-information="<?= $log['approval_status']; ?>"><i class="fas fa-fw fa-check"></i></a>
                                </div>
                                <!-- Button Reject Report Log -->
                                <div class="tooltip-wrapper" data-toggle="tooltip" data-placement="left" data-original-title="#">
                                    <a href="#" id="rejectProblemReport" class="btn btn-sm btn-danger btn-reject-log" data-user="<?= $role['id_role']; ?>" data-url="<?= base_url('manager/pemasaran'); ?>" data-id="<?= $log['id_user_cancellation']; ?>" data-information="<?= $log['approval_status']; ?>"><i class="fas fa-fw fa-times"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal View Problem Report -->
<div class="modal fade" id="modalReport">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
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
                    <table class="table table-sm table-borderless table-responsive-sm">
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
                                <th>Reported By</th>
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
                            <tr>
                                <th>Suggestion Solution</th>
                                <th>:</th>
                                <td id="data-solution"></td>
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
        $('.table-problemLog').DataTable({
            'destroy': true,
            'dom': '<"float-sm-left"l>ftrip',
            'responsive': true,
            'pageLength': -1,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            'scrollY': '350px',
            'scrollX': true,
            'scrollCollapse': true,
            'fixedColumns': true,
            'order': [
                [0, "asc"]
            ],
            'columnDefs': [{
                'targets': 5,
                'searchable': false,
                'orderable': false,
                'width': '130px'
            }, {
                'targets': 4,
                'width': '110px'
            }, {
                'targets': [1, 2, 3],
                'orderable': false,
                'width': '190px'
            }, {
                'targets': 0,
                'width': '120px'
            }]
        });
    });
</script>

<?= $this->endSection(); ?>