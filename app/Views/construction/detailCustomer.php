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

    <!-- File and Laporan -->
    <div class="row">
        <div class="col-lg">
            <div class="card shadow text-center mt-3 border-0">
                <div class="card-header bg-transparent border-0">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="reportLog-tab" data-toggle="tab" href="#reportLog" role="tab" aria-controls="reportLog" aria-selected="true">Report Log</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="file-tab" data-toggle="tab" href="#file" role="tab" aria-controls="file" aria-selected="true">File</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <!-- Report Log Tab Pane -->
                        <div class="tab-pane fade show active" id="reportLog" role="tabpanel" aria-labelledby="reportLog-tab">
                            <!-- Button Create Report -->
                            <div class="pb-3 d-sm-flex">
                                <a href="<?= base_url('construction/log-form/' . $customer['id_customer']); ?>" class="btn btn-primary "><i class="fas fa-fw fa-file-alt"></i> Create Report</a>
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
                                                    <div class="tooltip-wrapper" data-toggle="tooltip" data-placement="left" data-original-title="#">
                                                        <a href="#" class="btn btn-sm btn-info btn-edit-log" data-url="<?= base_url('construction'); ?>" data-id="<?= $log['id_user_report']; ?>" data-information="<?= $log['approval_status']; ?>"><i class="fas fa-edit"></i></a>
                                                    </div>
                                                    <div class="tooltip-wrapper" data-toggle="tooltip" data-placement="left" data-original-title="#">
                                                        <form action="#" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button class="btn btn-sm btn-danger btn-delete-log" data-url="<?= base_url('construction'); ?>" data-id="<?= $log['id_user_report']; ?>" data-information="<?= $log['approval_status']; ?>"><i class="fas fa-trash-alt" type="button"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- File Tab Pane -->
                        <div class="tab-pane fade active" id="file" role="tabpanel" aria-labelledby="file-tab">
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
                                                    <a href="#" class="btn btn-sm btn-pdf-viewer btn-info" data-toggle="modal" data-target="#modalPDF" data-url='<?= base_url('/' . $file['file_path']); ?>'><i class=" fas fa-fw fa-eye"></i></a>
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
                </div>
            </div>
        </div>
    </div>


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
<!-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Est, vel a. Ipsa nulla soluta enim ducimus excepturi consectetur labore ut fuga, repellat exercitationem explicabo voluptas eveniet quia, sequi ab tempora.</p> -->
<script>
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
                'width': '100px'
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
</script>

<script src="<?= base_url('assets/js/btnConstruction.js'); ?>"></script>

<?= $this->endSection(); ?>