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
            <div class="row">
                <div class="col">
                    <a href="#customerProfile" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="customerProfile">
                        <h5 class="font-weight-bold">Customer Profile</h5>
                    </a>
                    <div class="col">
                        <div class="collapse show multi-collapse overflow-auto" id="customerProfile">
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
                <div class="col">
                    <a href="#companyProfile" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="companyProfile">
                        <h5 class="font-weight-bold">Company Profile</h5>
                    </a>
                    <div class="col">
                        <div class="collapse show multi-collapse overflow-auto" id="companyProfile">
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
                                        <td id="date_of_establishment"><?= localizedTimeString($customer['date_of_establishment']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <a href="#companyLeader" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="companyLeader">
                        <h5 class="font-weight-bold">Chief / Leader</h5>
                    </a>
                    <div class="col">
                        <div class="collapse show multi-collapse overflow-auto" id="companyLeader">
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>:</td>
                                        <td id="name_company_leader"><?= $customer['name_company_leader']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Position</td>
                                        <td>:</td>
                                        <td id="position_company_leader"><?= $customer['position_company_leader']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>:</td>
                                        <td id="phone_company_leader"><?= $customer['phone_company_leader']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td id="email_company_leader"><?= $customer['email_company_leader']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <a href="#companyFinance" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="companyFinance">
                        <h5 class="font-weight-bold">Finance Affair</h5>
                    </a>
                    <div class="col">
                        <div class="collapse show multi-collapse overflow-auto" id="companyFinance">
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
                <div class="col">
                    <a href="#companyEngineering" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="companyEngineering">
                        <h5 class="font-weight-bold">Engineering Affair</h5>
                    </a>
                    <div class="col">
                        <div class="collapse show multi-collapse overflow-auto" id="companyEngineering">
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
                <div class="col">
                    <a href="#companyGeneral" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="companyGeneral">
                        <h5 class="font-weight-bold">General Affair</h5>
                    </a>
                    <div class="col">
                        <div class="collapse show multi-collapse overflow-auto" id="companyGeneral">
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
        <div class="card-footer bg-white px-0 ">
            <div class="row">
                <?php if (is_null($customer['id_pengawas'])) { ?>
                    <div class="col">
                        <button data-toggle="modal" data-target="#pilihPengawas" id="btn-pilih-pengawas" class="btn btn-sm btn-primary btn-pengawas float-right animate__animated animate__pulse animate__slow animate__infinite"><i class="fas fa-fw fa-user-check"></i> Pilih Pengawas Konstruksi</button>
                    </div>
                <?php } else { ?>
                    <span class="col-auto d-none d-lg-inline font-weight-bold text-primary">Pengawas :</span>
                    <div class="col-auto">
                        <?php if ($pengawas['image'] == 'default.jpg') { ?>
                            <img class="d-lg-inline rounded-circle" src="<?= base_url('assets/img/profile/' . $pengawas['image']); ?>" width="35" height="35">
                        <?php } else { ?>
                            <img class="d-lg-inline rounded-circle" src="<?= base_url('assets/img/profile/' . $pengawas['id_user'] . '/' . $pengawas['image']); ?>" width="35" height="35">
                        <?php } ?>
                        <span class="ml-2 d-none d-lg-inline text-gray-600 small"><?= $pengawas['name']; ?> </span>
                    </div>
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
                            <a class="nav-link active" id="file-tab" data-toggle="tab" href="#file" role="tab" aria-controls="file" aria-selected="true">File</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Laporan</a>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                        </li> -->
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="file" role="tabpanel" aria-labelledby="file-tab">
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
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quod rerum esse, illo quibusdam ipsum reprehenderit aperiam repudiandae accusantium beatae voluptatem dolores corrupti earum rem, odio provident assumenda. Quis, porro odio?</div>
                        <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate excepturi molestias dolores consectetur iste quidem unde delectus id eveniet quos odio maiores tempora minima quod quaerat, nihil nesciunt aspernatur perspiciatis!</div> -->
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
            //     'targets': [2, 3],
            //     'width': '85px'
            // }, {
            //     'targets': 6,
            //     'width': "161px"
            // }],
        });
    });
</script>

<?= $this->endSection(); ?>