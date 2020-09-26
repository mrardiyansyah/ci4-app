<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">

            <div class="col-lg-9">
                <?= session()->get('message'); ?>
            </div>

            <div class="card text-left">
                <div class="card-header">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs card-header-tabs" role="tablist" id="myTab">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" role="tab" href="#profileCustomer">Profile</a>
                        </li>
                    </ul>
                </div>

                <!-- Tab Panes -->
                <div class="card-body tab-content">
                    <div class="tab-pane active" id="profileCustomer" name="profileCustomer">

                        <!-- Button Edit and Delete -->
                        <a href="<?= base_url('planning/edit-customer/' . $customer['id_customer']); ?>" class="btn btn-sm btn-primary float-right" id="btn-edit-customer">
                            <i class="far fa-fw fa-edit"></i>
                            Edit
                        </a>

                        <h5 class="card-title text-uppercase text-dark font-weight-bold"><?= $customer['name_customer']; ?></h5>
                        <div style="overflow-x: auto;">
                            <table class="table table-sm table-borderless col-lg-9 table-responsive">
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

<?= $this->endSection(); ?>