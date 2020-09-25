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

                        <!-- Button Save and Cancel -->
                        <a href="<?= base_url('planning/detail-customer/' . $customer['id_customer']); ?>" class="btn btn-sm btn-secondary float-right ml-1" id="btn-save">
                            <i class="fas fa-fw fa-times"></i>
                            Cancel
                        </a>
                        <button class="btn btn-sm btn-primary float-right" id="btn-cancel-edit">
                            <i class="far fa-fw fa-save"></i>
                            Save
                        </button>

                        <form action="" method="post">
                            <table class="table table-sm table-borderless col-lg-9 ">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="PUT">
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" id="cust-name" name="cust-name" placeholder="Customer's Name" value="<?= $customer['name_customer']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ID Pelanggan</td>
                                        <td>:</td>
                                        <td id="id_pelanggan">
                                            <input class="form-control form-control-sm" type="number" name="id_pelanggan" id="id_pelanggan" value="<?= $customer['id_pelanggan']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td id="address_customer">
                                            <textarea class="form-control form-control-sm" name="address_customer" id="address_customer" cols="30" rows="4"><?= $customer['address_customer']; ?></textarea>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tarif</td>
                                        <td>:</td>
                                        <td id="tariff">
                                            <select id="tariff" name="tariff" class="col-sm-4 form-control custom-select custom-line-height custom-select-sm">
                                                <?php foreach ($tariff as $tarif) { ?>
                                                    <option value=" <?= $tarif['id_tariff'] ?>" <?= set_select('tariff', $tarif['id_tariff']); ?>><?= $tarif['tariff'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <?= $customer['tariff']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daya</td>
                                        <td>:</td>
                                        <td id="power">
                                            <input type="number" class="col-sm-2 form-control form-control-sm" id="power" name="power" value="<?= $customer['power']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Subsistem</td>
                                        <td>:</td>
                                        <td id="subsistem">
                                            <input type="text" class="form-control form-control-sm" id="subsistem" name="subsistem" value="<?= $customer['subsistem']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Substation</td>
                                        <td>:</td>
                                        <td id="substation">
                                            <select id="substation" name="substation" class="col-sm-4 form-control custom-select custom-line-height custom-select-sm" value="<?= $customer['name_substation']; ?>">
                                                <?php foreach ($substation as $subs) { ?>
                                                    <option value="<?= $subs['id_substation'] ?>" <?= set_select('substation', $subs['id_substation']); ?>><?= $subs['name_substation'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="min-width: 140px;">Feeder Substation</td>
                                        <td>:</td>
                                        <td id="feeder_substation">
                                            <select id="feeder-substation" name="feeder-substation" class="col-sm-4 form-control custom-select custom-line-height custom-select-sm" value="<?= set_value('feeder-substation'); ?>">
                                                <?php foreach ($feeder_substation as $fsubs) { ?>
                                                    <option value="<?= $fsubs['id_feeder_substation'] ?>" <?= set_select('feeder-substation', $fsubs['id_feeder_substation']); ?>><?= $fsubs['name_feeder_substation'] ?></option>
                                                <?php } ?>
                                                <?= $customer['name_feeder_substation']; ?>
                                            </select>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Layanan</td>
                                        <td>:</td>
                                        <td>
                                            <select id="recommend-service" name="recommend-service" class="col-sm-4 form-control custom-select custom-select-sm custom-line-height">
                                                <?php foreach ($service as $down) { ?>
                                                    <option value="<?= $down['id_type_of_service'] ?>" <?= set_select('recommend-service', $down['id_type_of_service']); ?>><?= $down['type_of_service'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td>
                                            <span class="badge <?= $customer['badge_status']; ?>">
                                                <?= $customer['status']; ?>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script type="text/javascript" src="<?= base_url('assets/js/tail.select-full.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/tail_lpremium.js'); ?>"></script>

<?= $this->endSection(); ?>