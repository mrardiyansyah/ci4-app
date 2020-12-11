<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.8.0/viewer.min.css" integrity="sha512-i7JFM7eCKzhlragtp4wNwz36fgRWH/Zsm3GAIqqO2sjiSlx7nQhx9HB3nmQcxDHLrJzEBQJWZYQQ2TPfexAjgQ==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.8.0/viewer.min.js" integrity="sha512-0Wn9X6EqYvivEQ+TqPycd7e2Py2FTP6ke9/v6CWFwg0+5G9lgRV4SyR7BApYriLL8dLB1OscA+8LrYA/X6wm3w==" crossorigin="anonymous"></script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Information Page -->
    <h1 class="h4 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="col-lg-8">
        <?= session()->get('message'); ?>
    </div>

    <div class="card shadow mt-2 border-5 pt-2 active pb-0 px-3">
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h3 class="card-title" style="color: cadetblue;"><b><?= $customer['name_customer']; ?></b></h3>
                    <hr>
                </div>
            </div>
            <!-- Customer and Company Profile -->
            <div class="row">
                <!-- Customer Profile -->
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

                <!-- Company Profile -->
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
                                            <td id="name_company"><?= $customer['name_company'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>:</td>
                                            <td id="address_company"><?= $customer['address_company'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>:</td>
                                            <td id="phone_company"><?= $customer['phone_company'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Facsimile</td>
                                            <td>:</td>
                                            <td id="facsimile"><?= $customer['facsimile'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td id="email_company"><?= $customer['email_company'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Establishment</td>
                                            <td>:</td>
                                            <td id="date_of_establishment"><?= ($customer['date_of_establishment']) ? localizedDateString($customer['date_of_establishment']) : '-'; ?></td>
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

            <!--  -->
            <div class="row">
                <!-- Chief Company -->
                <div class="col">
                    <div class="card shadow">
                        <h6 class="card-header bg-gradient-info">
                            <a data-toggle="collapse" href="#companyLeader" aria-expanded="true" aria-controls="companyLeader" id="heading-example" class="d-block text-decoration-none text-white collapsed">
                                <i class="fas fa-chevron-down fa-pull-right"></i>
                                Chief Company
                            </a>
                        </h6>
                        <div id="companyLeader" class="collapse multi-collapse overflow-auto" aria-labelledby="companyLeader-content">
                            <div class="card-body">
                                <table class="table table-sm table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td id="name_company_leader"><?= $customer['name_company_leader'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Position</td>
                                            <td>:</td>
                                            <td id="position_company_leader"><?= $customer['position_company_leader'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>:</td>
                                            <td id="phone_company_leader"><?= $customer['phone_company_leader'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td id="email_company_leader"><?= $customer['email_company_leader'] ?? '-'; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Finance Affairs -->
                <div class="col">
                    <div class="card shadow">
                        <h6 class="card-header bg-gradient-info">
                            <a data-toggle="collapse" href="#companyFinance" aria-expanded="true" aria-controls="companyFinance" id="heading-example" class="d-block text-decoration-none text-white collapsed">
                                <i class="fas fa-chevron-down fa-pull-right"></i>
                                Finance Affairs
                            </a>
                        </h6>
                        <div id="companyFinance" class="collapse multi-collapse overflow-auto" aria-labelledby="companyFinance-content">
                            <div class="card-body">
                                <table class="table table-sm table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td id="name_company_finance"><?= $customer['name_company_finance'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Position</td>
                                            <td>:</td>
                                            <td id="position_company_finance"><?= $customer['position_company_finance'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>:</td>
                                            <td id="phone_company_finance"><?= $customer['phone_company_finance'] ?? '-'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td id="email_company_finance"><?= $customer['email_company_finance'] ?? '-'; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Engineering Affairs -->
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

                <!-- General Affairs -->
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
                <div class="col-auto">
                    <span class="col-auto d-lg-inline font-weight-bold text-primary">Account Executive :</span>
                    <div class="d-inline-block mt-1">
                        <?php if ($ae['image'] == 'default.jpg') { ?>
                            <img class="d-lg-inline rounded-circle" src="<?= base_url('assets/img/profile/' . $ae['image']); ?>" width="35" height="35">
                        <?php } else { ?>
                            <img class="d-lg-inline rounded-circle" src="<?= base_url('assets/img/profile/' . $ae['id_user'] . '/' . $ae['image']); ?>" width="35" height="35">
                        <?php } ?>
                        <span class="ml-2 d-lg-inline text-gray-600 small"><?= $ae['name']; ?> </span>
                    </div>
                </div>
                <?php if ($customer['status'] == 'Energizing') : ?>
                    <div class="ml-auto col-auto d-sm-inline d-none">
                        <form action="<?= base_url('manager/pemasaran/energize-now/' . $customer['id_customer']); ?>" method="post" id="form-energize-now">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="PUT">
                            <button type="submit" class="btn btn-success btn-submit-energized animate__animated animate__flash  animate__slower"><i class="fas fa-bolt"></i> Ready for Energize!</button>
                        </form>
                    </div>
                <?php endif;  ?>
            </div>
        </div>
    </div>

    <!-- File and Laporan -->
    <?php if ($customer['id_status'] != 1) : ?>
        <div class="row">
            <div class="col-lg">
                <div class="card shadow text-center mt-3 border-0">
                    <!-- Card Header -->
                    <div class="card-header bg-transparent border-0">
                        <!-- Tab List -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="reportLog-tab" data-toggle="tab" href="#reportLog" role="tab" aria-controls="reportLog" aria-selected="true">Report Log</a>
                            </li>
                            <?php if ($customer['id_status'] > 3 && $customer['id_information'] != 11) : ?>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="constructionLog-tab" data-toggle="tab" href="#constructionLog" role="tab" aria-controls="constructionLog" aria-selected="true">Construction Log</a>
                                </li>
                            <?php endif; ?>
                            <?php if ($customer['id_status'] >= 3) : ?>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="file-tab" data-toggle="tab" href="#file" role="tab" aria-controls="file" aria-selected="true">File</a>
                                </li>
                            <?php endif; ?>
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
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <!-- Report Log Tab Pane -->
                            <div class="tab-pane fade show active" id="reportLog" role="tabpanel" aria-labelledby="reportLog-tab">
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
                                                <tr class="text-center">
                                                    <td><i class="fas fa-fw fa-calendar-alt"></i><?= localizedDateString($log['date_report']); ?><br><?= localizedTimeString($log['start_time']); ?> - <?= localizedTimeString($log['end_time']); ?></td>
                                                    <td><?= word_limiter($log['description'], 15, "..."); ?></td>
                                                    <td><span class="badge <?= $log['badge']; ?>"><?= $log['approval_status']; ?></span></td>
                                                    <td>
                                                        <!-- Button View Report -->
                                                        <div class="tooltip-wrapper mb-1" data-toggle="tooltip" data-placement="left" data-original-title="View Report">
                                                            <a href="#" id="viewReportLog" class="btn btn-sm btn-primary btn-view-report" data-toggle="modal" data-target="#modalReport" data-id="<?= $log['id_user_report']; ?>" data-url="<?= base_url('manager/report'); ?>" data-baseurl="<?= base_url(); ?>"><i class="fas fa-fw fa-eye"></i></a>
                                                        </div>
                                                        <!-- Button Approve Report Log -->
                                                        <div class="tooltip-wrapper mb-1" data-toggle="tooltip" data-placement="left" data-original-title="#">
                                                            <a href="#" id="approveReportLog" class="btn btn-sm btn-success btn-approve-log" data-url="<?= base_url('manager'); ?>" data-id="<?= $log['id_user_report']; ?>" data-information="<?= $log['approval_status']; ?>"><i class="fas fa-fw fa-check"></i></a>
                                                        </div>
                                                        <!-- Button Reject Report Log -->
                                                        <div class="tooltip-wrapper" data-toggle="tooltip" data-placement="left" data-original-title="#">
                                                            <a href="#" id="rejectReportLog" class="btn btn-sm btn-danger btn-reject-log" data-url="<?= base_url('manager'); ?>" data-id="<?= $log['id_user_report']; ?>" data-information="<?= $log['approval_status']; ?>"><i class="fas fa-fw fa-times"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- File Tab Pane -->
                            <?php if ($customer['id_status'] >= 3) : ?>
                                <div class="tab-pane fade" id="file" role="tabpanel" aria-labelledby="file-tab">
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
                                            <?php foreach ($file_closing as $file) : ?>
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
                            <!-- Construction Report -->
                            <?php if ($customer['id_status'] > 3 && $customer['id_information'] != 11) : ?>
                                <div class="tab-pane fade" id="constructionLog" role="tabpanel" aria-labelledby="constructionLog-tab">
                                    <table class="table table-bordered table-hover table-striped table-constructionLog" style="width: 100%;">
                                        <thead class="thead-dark">
                                            <tr class="text-center">
                                                <th scope="col">Date and Time</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($construction_log as $log) : ?>
                                                <tr class="text-center">
                                                    <td><i class="fas fa-fw fa-calendar-alt"></i><?= localizedDateString($log['date_report']); ?><br><?= localizedTimeString($log['start_time']); ?> - <?= localizedTimeString($log['end_time']); ?></td>
                                                    <td><?= word_limiter($log['description'], 15, "..."); ?></td>
                                                    <td><span class="badge <?= $log['badge']; ?>"><?= $log['approval_status']; ?></span></td>
                                                    <td>
                                                        <!-- Button View Report -->
                                                        <div class="tooltip-wrapper" data-toggle="tooltip" data-placement="left" data-original-title="View Report">
                                                            <a href="#" id="viewReportLog" class="btn btn-sm btn-primary btn-view-report" data-toggle="modal" data-target="#modalReport" data-id="<?= $log['id_user_report']; ?>" data-url="<?= base_url('manager/report'); ?>" data-baseurl="<?= base_url(); ?>"><i class="fas fa-eye"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
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
                                                        <td><i class="fas fa-fw fa-calendar-alt"></i><?= ($log['date_report']); ?><br><?= ($log['start_time']); ?> - <?= ($log['end_time']); ?></td>
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
                                    <!-- Button View Energize Documentation -->
                                    <div class="pb-3 float-left">
                                        <button class="btn btn-primary btn-view-energize" data-toggle="modal" id="viewImageEnergize" data-target="#modalEnergizeDoc" data-id="<?= $customer['id_customer']; ?>" data-url="<?= base_url('manager/energizing-doc'); ?>" data-baseurl="<?= base_url(); ?>">
                                            <i class="far fa-fw fa-images"></i> Energize Documentation
                                        </button>
                                    </div>
                                    <div>
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
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal PDF Viewer -->
<div class="modal fade" id="modalPDF" tabindex="-1" aria-labelledby="modalPDFLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPDFLabel">PDF Viewer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <iframe src="" style="width:600px; height:500px;" frameborder="0" id="pdf-viewer"></iframe> -->
                <embed src="" type="application/pdf" width="100%" height="600px" id="pdf-viewer" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Pilih Pengawas -->
<div class="modal hide fade" id="pilihPengawas" tabindex="-1" aria-labelledby="pilihPengawasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color:#1a94aa;">
                <h5 class="h5 modal-title" id="pilihPengawasLabel">Pilih Pengawas Konstruksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('manager/konstruksi/choose-pengawas/' . $customer['id_customer']); ?>" method="post">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <label for="pengawas">Nama Pengawas :</label>
                    <select id="pengawas" name="pengawas" class="form-control custom-select-sm">
                        <?php foreach ($user_construction as $uc) { ?>
                            <option value="<?= $uc['id_user'] ?>" <?= set_select('pengawas', $uc['id_user']); ?>><?= $uc['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal View Report -->
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
                                <th>Customer</th>
                                <th>:</th>
                                <td class="text-info font-weight-bold" id="data-customer"></td>
                            </tr>
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

<!-- Modal View Energize Documentation -->
<div class="modal fade" id="modalEnergizeDoc">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="energizeDoc" class="carousel slide project-slide" data-interval="false">
                    <div class="carousel-inner">
                        <div id="carousel-item-image-energize" style="cursor: zoom-in;">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#energizeDoc" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#energizeDoc" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
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
                'width': '110px'
            }]
        });
    });

    // Table Report Log (Construction)
    $(document).ready(function() {
        $('.table-constructionLog').DataTable({
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
                'width': '110px'
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

<script>
    window.addEventListener('DOMContentLoaded', function() {
        var galley = document.getElementById('carousel-item-image-energize');
        var viewer;

        $('#modalEnergizeDoc').on('shown.bs.modal', function(e) {
            // WARNING: should ignore Viewer's `shown` event here.
            if (e.namespace === 'bs.modal') {
                viewer = new Viewer(galley, {});
            }
        }).on('hidden.bs.modal', function(e) {
            // WARNING: should ignore Viewer's `hidden` event here.
            if (e.namespace === 'bs.modal') {
                viewer.destroy();
            }
        });
    });
</script>

<?= $this->endSection(); ?>