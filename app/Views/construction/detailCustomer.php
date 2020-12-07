<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Information Page -->
    <h1 class="h4 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="col-lg-8">
        <?= session()->get('message'); ?>
    </div>

    <div class="card shadow mt-2 border-5 pt-2 active pb-0 px-3">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title" style="color: cadetblue;"><b><?= $customer['name_customer']; ?></b></h3>
                    <hr>
                </div>
            </div>
            <!-- Customer and Company Profile -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <h6 class="card-header bg-gradient-info">
                            <a data-toggle="collapse" href="#customerProfile" aria-expanded="true" aria-controls="customerProfile" id="heading-example" class="d-block text-decoration-none text-white">
                                <i class="fas fa-chevron-down fa-pull-right "></i>
                                <span class="">
                                    Customer Profile
                                </span>
                            </a>
                        </h6>
                        <div id="customerProfile" class="collapse show multi-collapse overflow-auto" aria-labelledby="customerProfile-content">
                            <div class="card-body">
                                <table class="table table-responsive-sm table-sm table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>ID Pelanggan</td>
                                            <td>:</td>
                                            <td id="id_pelanggan"><?= $customer['id_pelanggan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td id="address_customer"><?= $customer['address_customer']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tarif</td>
                                            <td>:</td>
                                            <td id="tariff"><?= $customer['tariff']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Daya</td>
                                            <td>:</td>
                                            <td id="power"><?= $customer['power']; ?> VA</td>
                                        </tr>
                                        <tr>
                                            <td>Subsistem</td>
                                            <td>:</td>
                                            <td id="subsistem"><?= $customer['subsistem']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Substation</td>
                                            <td>:</td>
                                            <td id="substation"><?= $customer['name_substation']; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="min-width: 140px;">Feeder Substation</td>
                                            <td>:</td>
                                            <td id="feeder_substation"><?= $customer['name_feeder_substation']; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="min-width: 140px;">BEP Value</td>
                                            <td>:</td>
                                            <td id="bep-value"><?= $customer['bep_value']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Layanan</td>
                                            <td>:</td>
                                            <td><span class="badge <?= $customer['badge']; ?>"><?= $customer['type_of_service']; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>:</td>
                                            <td><span class="badge <?= $customer['badge_status']; ?>"><?= $customer['status']; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Information</td>
                                            <td>:</td>
                                            <td><?= $customer['information']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow">
                        <h6 class="card-header bg-gradient-info">
                            <a data-toggle="collapse" href="#companyProfile" aria-expanded="true" aria-controls="companyProfile" id="heading-example" class="d-block text-decoration-none text-white">
                                <i class="fas fa-chevron-down fa-pull-right"></i>
                                Company Profile
                            </a>
                        </h6>
                        <div id="companyProfile" class="collapse show multi-collapse overflow-auto" aria-labelledby="companyProfile-content">
                            <div class="card-body">
                                <table class="table table-sm table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td id="name_company"><?= $customer['name_company']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>:</td>
                                            <td id="address_company"><?= $customer['address_company']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>:</td>
                                            <td id="phone_company"><?= $customer['phone_company']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Facsimile</td>
                                            <td>:</td>
                                            <td id="facsimile"><?= $customer['facsimile']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td id="email_company"><?= $customer['email_company']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Establishment</td>
                                            <td>:</td>
                                            <td id="date_of_establishment"><?= localizedDateString($customer['date_of_establishment']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <hr>

            <!-- Engineering and General Affairs -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <h6 class="card-header bg-gradient-info">
                            <a data-toggle="collapse" href="#companyEngineering" aria-expanded="true" aria-controls="companyEngineering" id="heading-example" class="d-block text-decoration-none text-white collapsed">
                                <i class="fas fa-chevron-down fa-pull-right"></i>
                                Engineering Affairs
                            </a>
                        </h6>
                        <div id="companyEngineering" class="collapse multi-collapse overflow-auto" aria-labelledby="companyEngineering-content">
                            <div class="card-body">
                                <table class="table table-sm table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td id="name_company_engineering"><?= $customer['name_company_engineering'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Position</td>
                                            <td>:</td>
                                            <td id="position_company_engineering"><?= $customer['position_company_engineering'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>:</td>
                                            <td id="phone_company_engineering"><?= $customer['phone_company_engineering'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td id="email_company_engineering"><?= $customer['email_company_engineering'] ?? '-'; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow">
                        <h6 class="card-header bg-gradient-info">
                            <a data-toggle="collapse" href="#companyGeneral" aria-expanded="true" aria-controls="companyGeneral" id="heading-example" class="d-block text-decoration-none text-white collapsed">
                                <i class="fas fa-chevron-down fa-pull-right"></i>
                                General Affairs
                            </a>
                        </h6>
                        <div id="companyGeneral" class="collapse multi-collapse overflow-auto" aria-labelledby="companyGeneral-content">
                            <div class="card-body">
                                <table class="table table-sm table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td id="name_company_general"><?= $customer['name_company_general'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Position</td>
                                            <td>:</td>
                                            <td id="position_company_general"><?= $customer['position_company_general'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>:</td>
                                            <td id="phone_company_general"><?= $customer['phone_company_general'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td id="email_company_general"><?= $customer['email_company_general'] ?? '-'; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card Footer -->
        <div class="card-footer bg-white px-0 ">
            <div class="row">
                <span class="col-auto  d-lg-inline font-weight-bold text-primary">Pengawas :</span>
                <div class="col-auto">
                    <?php if ($pengawas['image'] == 'default.jpg') { ?>
                        <img class="d-lg-inline rounded-circle" src="<?= base_url('assets/img/profile/' . $pengawas['image']); ?>" width="35" height="35">
                    <?php } else { ?>
                        <img class="d-lg-inline rounded-circle" src="<?= base_url('assets/img/profile/' . $pengawas['id_user'] . '/' . $pengawas['image']); ?>" width="35" height="35">
                    <?php } ?>
                    <span class="ml-2 d-lg-inline text-gray-600 small"><?= $pengawas['name']; ?> </span>
                </div>
                <?php if ($customer['id_information'] == 8) { ?>
                    <div class="ml-auto col-auto d-sm-inline d-none">
                        <span class="text-warning small font-weight-bolder animate__animated animate__flash animate__infinite animate__slower">&#8226; On Construction</span>
                    </div>
                <?php } else if ($customer['id_information'] == 7) { ?>
                    <form action="<?= base_url('construction'); ?>" method="post" id="form-start-construct">
                        <?= csrf_field(); ?>
                        <div class="ml-auto col-auto d-sm-inline pt-3">
                            <button class="btn btn-sm btn-primary btn-submit-construct" title="Start Construct Now!" type="submit" data-id="<?= $customer['id_customer']; ?>"><i class="fas fa-fw fa-tools" id="btn-submit-construct"></i> Start Construct</button>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Report, File, File Energize and Problem Report -->
    <div class="row">
        <div class="col-lg">
            <div class="card shadow text-center mt-3 border-0">
                <div class="card-header bg-transparent border-0">
                    <!-- Tab List -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <?php if ($customer['id_information'] >= 8) : ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="reportLog-tab" data-toggle="tab" href="#reportLog" role="tab" aria-controls="reportLog" aria-selected="true">Report Log</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?= ($customer['id_information'] >= 8) ? '' : 'active' ?>" id="file-tab" data-toggle="tab" href="#file" role="tab" aria-controls="file" aria-selected="true">File</a>
                        </li>
                        <?php if (!empty($cancellation_report)) :  ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="problemLog-tab" data-toggle="tab" href="#problemLog" role="tab" aria-controls="problemLog" aria-selected="true">Problem Report Log</a>
                            </li>
                        <?php endif; ?>
                        <?php if ($customer['id_status'] >= 5) : ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="energize-tab" data-toggle="tab" href="#energize" role="tab" aria-controls="energize" aria-selected="true">Energize</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <!-- Report Log Tab Pane -->
                        <?php if ($customer['id_information'] >= 8) : ?>
                            <div class="tab-pane fade show active" id="reportLog" role="tabpanel" aria-labelledby="reportLog-tab">
                                <!-- Button Create Report -->
                                <div class="dropdown pb-3 d-sm-flex">
                                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownReportLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Create Report
                                    </a>
                                    <div class="dropdown-menu animate__animated animate__zoomIn animate__faster" aria-labelledby="dropdownReportLink">
                                        <a class="dropdown-item text-primary" href="<?= base_url('construction/log-form/' . $customer['id_customer']); ?>"><i class="fas fa-fw fa-file-alt"></i> Construction Report</a>
                                        <?php if ($customer['id_status'] < 5) : ?>
                                            <a class="dropdown-item text-success" href="<?= base_url('construction/energize/' . $customer['id_customer']); ?>"><i class="fas fa-fw fa-bolt"></i> Energizing</a>
                                        <?php endif; ?>
                                        <?php if (empty($cancellation_report) && $customer['id_status'] != 5) : ?>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="<?= base_url('construction/problem-form/' . $customer['id_customer']); ?>"><i class="fas fa-fw fa-exclamation-triangle"></i> Problem Report</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <table class="table table-bordered table-hover table-striped table-reportLog" style="width: 100%;">
                                        <thead class="thead-dark">
                                            <tr class="text-center">
                                                <th scope="col">Date and Time</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($report_log as $log) : ?>
                                                <tr>
                                                    <td><i class="fas fa-fw fa-calendar-alt"></i><?= localizedDateString($log['date_report']); ?><br><?= localizedTimeString($log['start_time']); ?> - <?= localizedTimeString($log['end_time']); ?></td>
                                                    <td><?= excerpt($log['description'], NULL, 80); ?></td>
                                                    <td><span class="badge <?= $log['badge']; ?>"><?= $log['approval_status']; ?></span></td>
                                                    <td>
                                                        <div class="tooltip-wrapper" data-toggle="tooltip" data-placement="left" data-original-title="View Report">
                                                            <a href="#" id="editReportLog" class="btn btn-sm btn-primary btn-view-report" data-toggle="modal" data-target="#modalReport" data-id="<?= $log['id_user_report']; ?>" data-url="<?= base_url('construction/report'); ?>" data-baseurl="<?= base_url(); ?>"><i class="fas fa-eye"></i></a>
                                                        </div>
                                                        <div class="tooltip-wrapper" data-toggle="tooltip" data-placement="left" data-original-title="#">
                                                            <a href="#" id="editReportLog" class="btn btn-sm btn-info btn-edit-log" data-url="<?= base_url('construction'); ?>" data-id="<?= $log['id_user_report']; ?>" data-information="<?= $log['approval_status']; ?>"><i class="fas fa-edit"></i></a>
                                                        </div>
                                                        <div class="tooltip-wrapper" data-toggle="tooltip" data-placement="left" data-original-title="#">
                                                            <form action="#" method="post">
                                                                <?= csrf_field(); ?>
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button id="deleteReportLog" class="btn btn-sm btn-danger btn-delete-log" data-url="<?= base_url('construction'); ?>" data-id="<?= $log['id_user_report']; ?>" data-information="<?= $log['approval_status']; ?>"><i class="fas fa-trash-alt" type="button"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- File Tab Pane -->
                        <div class="tab-pane fade <?= ($customer['id_information'] >= 8) ? '' : 'show active' ?>" id="file" role="tabpanel" aria-labelledby="file-tab">
                            <table class="table table-bordered table-hover table-striped table-file" style="width: 100%;">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Nama File</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Uploaded By</th>
                                        <th scope="col">Timestamp</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php $j = 1; ?>
                                    <?php $file_name_temp = ''; ?>
                                    <?php foreach ($file_construction as $file) : ?>
                                        <?php $nama_file = renameFile($file['storage_file_name']); ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <?php if ($nama_file == $file_name_temp) { ?>
                                                <td><?= $nama_file . "($j)"; ?></td>
                                            <?php
                                                $j++;
                                            } else { ?>
                                                <td><?= $nama_file; ?></td>
                                            <?php } ?>
                                            <td class="text-center"><?= bytesToHuman($file['size']); ?></td>
                                            <td class="text-center"><?= $file['description']; ?></td>
                                            <td class="text-center"><?= $file['name']; ?></td>
                                            <td class="text-center"><?= ($file['created_at']); ?></td>
                                            <td class="text-center">
                                                <div class="tooltip-wrapper" data-toggle="tooltip" data-placement="left" data-original-title="View PDF File">
                                                    <a href="<?= base_url('viewer/' . $file['id_file']); ?>" target="_blank" class="btn btn-sm btn-info"><i class=" fas fa-fw fa-eye"></i></a>
                                                </div>
                                            </td>

                                        </tr>
                                        <?php $i++; ?>
                                        <?php $file_name_temp = $nama_file ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Problem Report Log Tab Pane -->
                        <?php if (!empty($cancellation_report)) : ?>
                            <div class="tab-pane fade" id="problemLog" role="tabpanel" aria-labelledby="problemLog-tab">
                                <div>
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
                                            <?php foreach ($cancellation_report as $log) : ?>
                                                <tr>
                                                    <td><i class="fas fa-fw fa-calendar-alt"></i><?= localizedDateString($log['date_report']); ?><br><?= localizedTimeString($log['start_time']); ?> - <?= localizedTimeString($log['end_time']); ?></td>
                                                    <td><?= excerpt($log['description'], NULL, 80); ?></td>
                                                    <td><?= (!is_null($log['suggestion_solution'])) ? excerpt($log['suggestion_solution'], NULL, 80) : '-'; ?></td>
                                                    <td><?= (!is_null($log['solutions'])) ? excerpt($log['solutions'], NULL, 80) : '-'; ?></td>
                                                    <td><span class="badge <?= $log['badge']; ?>"><?= $log['approval_status']; ?></span></td>
                                                    <td>
                                                        <div class="tooltip-wrapper" data-toggle="tooltip" data-placement="left" data-original-title="#">
                                                            <a href="#" id="editProblemLog" class="btn btn-sm btn-info btn-edit-log" data-url="<?= base_url('construction'); ?>" data-id="<?= $log['id_user_cancellation']; ?>" data-information="<?= $log['approval_status']; ?>"><i class="fas fa-edit"></i></a>
                                                        </div>
                                                        <div class="tooltip-wrapper" data-toggle="tooltip" data-placement="left" data-original-title="#">
                                                            <form action="#" method="post">
                                                                <?= csrf_field(); ?>
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button id="deleteProblemLog" class="btn btn-sm btn-danger btn-delete-log" data-url="<?= base_url('construction'); ?>" data-id="<?= $log['id_user_cancellation']; ?>" data-information="<?= $log['approval_status']; ?>"><i class="fas fa-trash-alt" type="button"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- Energize Tab Pane -->
                        <?php if ($customer['id_status'] >= 5) : ?>
                            <div class="tab-pane fade <?= ($customer['id_information'] >= 8) ? '' : 'show active' ?>" id="energize" role="tabpanel" aria-labelledby="energize-tab">
                                <table class="table table-bordered table-hover table-striped table-energize" style="width: 100%;">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th scope="col">#</th>
                                            <th scope="col">Nama File</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Uploaded By</th>
                                            <th scope="col">Timestamp</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php $j = 1; ?>
                                        <?php $file_name_temp = ''; ?>
                                        <?php foreach ($file_energize as $file) : ?>
                                            <?php $nama_file = renameFile($file['storage_file_name']); ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <?php if ($nama_file == $file_name_temp) { ?>
                                                    <td><?= $nama_file . "($j)"; ?></td>
                                                <?php
                                                    $j++;
                                                } else { ?>
                                                    <td><?= $nama_file; ?></td>
                                                <?php } ?>
                                                <td class="text-center"><?= bytesToHuman($file['size']); ?></td>
                                                <td class="text-center"><?= $file['description']; ?></td>
                                                <td class="text-center"><?= $file['name']; ?></td>
                                                <td class="text-center"><?= ($file['created_at']); ?></td>
                                                <td class="text-center">
                                                    <div class="tooltip-wrapper" data-toggle="tooltip" data-placement="left" data-original-title="View PDF File">
                                                        <a href="<?= base_url('viewer/' . $file['id_file']); ?>" target="_blank" class="btn btn-sm btn-info"><i class=" fas fa-fw fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                            <?php $file_name_temp = $nama_file ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
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
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
        // .responsive.recalc();
    });

    // Table File
    $(document).ready(function() {
        $('.table-file').DataTable({
            'destroy': true,
            'dom': 'ftri',
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
                [1, "asc"]
            ],
            'columnDefs': [{
                'targets': [-1, 0, 2],
                'searchable': false,
                'orderable': false
            }]
        });
    });

    // Table Energize
    $(document).ready(function() {
        $('.table-energize').DataTable({
            'destroy': true,
            'dom': 'ftri',
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
                [1, "asc"]
            ],
            'columnDefs': [{
                'targets': [-1, 0, 2],
                'searchable': false,
                'orderable': false
            }]
        });
    });

    // Table Report Log
    $(document).ready(function() {
        $('.table-reportLog').DataTable({
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
                'targets': 3,
                'searchable': false,
                'orderable': false,
                'width': '150px'
            }, {
                'targets': 2,
                'width': '110px'
            }, {
                'targets': 1,
                'orderable': false
            }, {
                'targets': 0,
                'width': '120px'
            }]
        });
    });

    // Table Problem Log
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
                'width': '100px'
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

<script src="<?= base_url('assets/js/btnConstruction.js'); ?>"></script>

<?= $this->endSection(); ?>