<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<script type="text/javascript" src="<?= base_url('assets/js/tail.select-full.min.js'); ?>"></script>
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
                        <form action="<?= base_url('planning/edit-customer/' . $customer['id_customer']); ?>" method="post">
                            <button type="submit" class="btn btn-sm btn-primary float-right" id="btn-cancel-edit">
                                <i class="far fa-fw fa-save"></i>
                                Save
                            </button>

                            <table class="table table-sm table-borderless col-lg-9 ">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="PUT">
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('cust-name') ? 'is-invalid' : ''; ?>" id="cust-name" name="cust-name" placeholder="Customer's Name" value="<?= $customer['name_customer']; ?>" autofocus>
                                            <?php if (isset($validation)) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('cust-name'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ID Pelanggan</td>
                                        <td>:</td>
                                        <td>
                                            <input class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('id_pelanggan') ? 'is-invalid' : ''; ?>" type="number" name="id_pelanggan" placeholder="ID Pelanggan" id="id_pelanggan" value="<?= $customer['id_pelanggan']; ?>">
                                            <?php if (isset($validation)) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('id_pelanggan'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td id="address_customer">
                                            <textarea class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('address_customer') ? 'is-invalid' : ''; ?>" name="address_customer" id="address_customer" cols="30" rows="4"><?= $customer['address_customer']; ?></textarea>
                                            <?php if (isset($validation)) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('address_customer'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tarif</td>
                                        <td>:</td>
                                        <td>
                                            <select id="tariff" name="tariff" class="col-sm-4 form-control custom-select custom-line-height custom-select-sm <?php if (isset($validation)) echo $validation->hasError('tariff') ? 'is-invalid' : ''; ?>">
                                                <?php foreach ($tariff as $tarif) { ?>
                                                    <option value=" <?= $tarif['id_tariff'] ?>" <?= set_select('tariff', $tarif['id_tariff']); ?> <?= ($customer['tariff'] == $tarif['tariff']) ? 'selected' : ''; ?>><?= $tarif['tariff'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if (isset($validation)) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('tariff'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daya</td>
                                        <td>:</td>
                                        <td>
                                            <input type="number" class="col-sm-3 form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('power') ? 'is-invalid' : ''; ?>" id="power" name="power" value="<?= $customer['power']; ?>">
                                            <?php if (isset($validation)) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('power'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Subsistem</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('subsistem') ? 'is-invalid' : ''; ?>" id="subsistem" name="subsistem" value="<?= $customer['subsistem']; ?>">
                                            <?php if (isset($validation)) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('subsistem'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Substation</td>
                                        <td>:</td>
                                        <td>
                                            <select id="substation" name="substation" class="col-sm-4 form-control custom-select custom-line-height custom-select-sm <?php if (isset($validation)) echo $validation->hasError('substatio') ? 'is-invalid' : ''; ?>" value="<?= $customer['name_substation']; ?>">
                                                <?php foreach ($substation as $subs) { ?>
                                                    <option value="<?= $subs['id_substation'] ?>" <?= ($customer['name_substation'] == $subs['name_substation']) ? 'selected' : ''; ?>><?= $subs['name_substation'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if (isset($validation)) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('substation'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="min-width: 140px;">Feeder Substation</td>
                                        <td>:</td>
                                        <td>
                                            <select id="feeder-substation" name="feeder-substation" class="col-sm-4 form-control custom-select custom-line-height custom-select-sm <?php if (isset($validation)) echo $validation->hasError('feeder-substation') ? 'is-invalid' : ''; ?>" value="<?= set_value('feeder-substation'); ?>">
                                                <?php foreach ($feeder_substation as $fsubs) { ?>
                                                    <option value="<?= $fsubs['id_feeder_substation'] ?>" <?= ($customer['name_feeder_substation'] == $fsubs['name_feeder_substation']) ? 'selected' : '';; ?>><?= $fsubs['name_feeder_substation'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if (isset($validation)) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('feeder-substation'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="min-width: 140px;">BEP Value</td>
                                        <td>:</td>
                                        <td>
                                            <input type="number" class="col-sm-2 form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('bep-value') ? 'is-invalid' : ''; ?>" id="bep-value" name="bep-value" value="<?= $customer['bep_value']; ?>">
                                            <?php if (isset($validation)) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('bep-value'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Layanan</td>
                                        <td>:</td>
                                        <td>
                                            <select id="recommend-service" name="recommend-service" class="col-sm-4 form-control custom-select custom-select-sm custom-line-height <?php if (isset($validation)) echo $validation->hasError('recommend-service') ? 'is-invalid' : ''; ?>">
                                                <?php foreach ($service as $down) { ?>
                                                    <option value="<?= $down['id_type_of_service'] ?>" <?= ($customer['type_of_service'] == $down['type_of_service']) ? 'selected' : ''; ?> <?= set_select('recommend-service', $down['id_type_of_service']); ?>><?= $down['type_of_service'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if (isset($validation)) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('recommend-service'); ?>
                                                </div>
                                            <?php endif; ?>
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


<script src="<?= base_url('assets/js/tail_lpremium.js'); ?>"></script>

<?= $this->endSection(); ?>