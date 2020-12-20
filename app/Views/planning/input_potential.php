<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <div class="row">
                <div class="col-lg-6">
                    <?= session()->get('message'); ?>
                </div>

            </div>
            <button class="btn btn-sm btn-facebook mb-3 input-file-potential" type="button" data-toggle="modal" data-target="#modalInputFilePotential">
                <i class="fas fa-plus-circle text-white mr-2"></i>
                Input Data With Excel
            </button>

            <form action="<?= base_url('planning/add-potential'); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="card col-lg">
                    <div class="card-body col-lg-11">
                        <div class="form-group row">
                            <label for="cust-name" class="col-sm-3 col-form-label col-form-label-sm">Customer Name *</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="cust-name" name="cust-name" placeholder="Customer's Name" value="<?= set_value('cust-name'); ?>">
                                <?php if (isset($validation)) : ?>
                                    <div class="text-danger pl-1" role="alert">
                                        <?= $validation->getError('cust-name'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cust-id" class="col-sm-3 col-form-label col-form-label-sm">ID Customer *</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control form-control-sm" id="cust-id" name="cust-id" placeholder="ID Customer's" value="<?= set_value('cust-id'); ?>">
                                <?php if (isset($validation)) : ?>
                                    <div class="text-danger pl-1" role="alert">
                                        <?= $validation->getError('cust-id'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tariff" class="col-sm-3 col-form-label col-form-label-sm">Tarif *</label>
                            <div class="col-sm-8">
                                <select id="tariff" name="tariff" class="col-sm-4 form-control custom-select custom-line-height custom-select-sm" value="<?= set_value('tariff'); ?>">
                                    <?php foreach ($tariff as $tarif) { ?>
                                        <option value="<?= $tarif['id_tariff'] ?>" <?= set_select('tariff', $tarif['id_tariff']); ?>><?= $tarif['tariff'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php if (isset($validation)) : ?>
                                    <div class="text-danger pl-1" role="alert">
                                        <?= $validation->getError('tariff'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="power" class="col-sm-3 col-form-label col-form-label-sm">Daya (VA) *</label>
                            <div class="col-sm-8">
                                <input type="number" class="col-sm-3 form-control form-control-sm" id="power" name="power" value="<?= set_value('power'); ?>">
                                <?php if (isset($validation)) : ?>
                                    <div class="text-danger pl-1" role="alert">
                                        <?= $validation->getError('power'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cust-address" class="col-sm-3 col-form-label col-form-label-sm">Address *</label>
                            <div class="col-sm-8">
                                <textarea class="form-control form-control-sm" name="cust-address" id="cust-address" cols="30" rows="4" placeholder="Address Customer's" value="<?= set_value('cust-address'); ?>"><?= set_value('cust-address'); ?></textarea>
                                <?php if (isset($validation)) : ?>
                                    <div class="text-danger pl-1" role="alert">
                                        <?= $validation->getError('cust-address'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="substation" class="col-sm-3 col-form-label col-form-label-sm">Substation *</label>
                            <div class="col-sm-8">
                                <!-- <input type="text" class="form-control form-control-sm" id="substation" name="substation"> -->
                                <select id="substation" name="substation" class="col-sm-4 form-control custom-select custom-line-height custom-select-sm" value="<?= set_value('substation'); ?>">
                                    <?php foreach ($substation as $subs) { ?>
                                        <option value="<?= $subs['id_substation'] ?>" <?= set_select('substation', $subs['id_substation']); ?>><?= $subs['name_substation'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php if (isset($validation)) : ?>
                                    <div class="text-danger pl-1" role="alert">
                                        <?= $validation->getError('substation'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="feeder-substation" class="col-sm-3 col-form-label col-form-label-sm">Feeder Substation *</label>
                            <div class="col-sm-8">
                                <!-- <input type="text" class="form-control form-control-sm" id="feeder-substation" name="feeder-substation"> -->
                                <select id="feeder-substation" name="feeder-substation" class="col-sm-4 form-control custom-select custom-line-height custom-select-sm" value="<?= set_value('feeder-substation'); ?>">
                                    <?php foreach ($feeder_substation as $fsubs) { ?>
                                        <option value="<?= $fsubs['id_feeder_substation'] ?>" <?= set_select('feeder-substation', $fsubs['id_feeder_substation']); ?>><?= $fsubs['name_feeder_substation'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php if (isset($validation)) : ?>
                                    <div class="text-danger pl-1" role="alert">
                                        <?= $validation->getError('feeder-substation'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subsistem" class="col-sm-3 col-form-label col-form-label-sm">Subsistem *</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="subsistem" name="subsistem" value="<?= set_value('subsistem'); ?>">
                                <?php if (isset($validation)) : ?>
                                    <div class="text-danger pl-1" role="alert">
                                        <?= $validation->getError('subsistem'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bep-value" class="col-sm-3 col-form-label col-form-label-sm">BEP Value *</label>
                            <div class="col-sm-8">
                                <input type="number" step="any" class="form-control form-control-sm" id="bep-value" name="bep-value" value="<?= set_value('bep-value'); ?>">
                                <?php if (isset($validation)) : ?>
                                    <div class="text-danger pl-1" role="alert">
                                        <?= $validation->getError('bep-value'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="recommend-service" class="col-sm-3 col-form-label col-form-label-sm">Service Recommendation*</label>
                            <div class="col-sm-8">
                                <select id="recommend-service" name="recommend-service" class="col-sm-4 form-control custom-select custom-select-sm custom-line-height">
                                    <?php foreach ($service as $down) { ?>
                                        <option value="<?= $down['id_type_of_service'] ?>" <?= set_select('recommend-service', $down['id_type_of_service']); ?>><?= $down['type_of_service'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php if (isset($validation)) : ?>
                                    <div class="text-danger pl-1" role="alert">
                                        <?= $validation->getError('recommend-service'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <button class="btn btn-sm btn-primary" type="submit" name="save" id="save">Input Data</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close(); ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="modalInputFilePotential" tabindex="-1" role="dialog" aria-labelledby="modalInputFilePotentialTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a94aa;">
                <h5 class="modal-title text-white" style="font-size:normal;" id="modalInputFilePotentialTitle">Input
                    Data Potential With Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body mt-3">
                <form action="<?= base_url('planning/import-file') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label for="file_excel" class="col-sm-3 col-form-label">File</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="form-control custom-file-input" id="file_excel" name="file_excel">
                                <label class="custom-file-label" for="file_excel">Choose file</label>
                            </div>
                            <div class="label font-italic mt-1" style="font-size:small;">
                                * Must use an Existing Template (.xlsx)
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary " id="input-potential-file"><i class="fas fa-cloud-upload-alt text-white mr-1"></i> Upload File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= base_url('assets/js/tail.select-full.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/tail_lpremium.js'); ?>"></script>

<?= $this->endSection(); ?>