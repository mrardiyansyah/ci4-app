<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <div class="col-lg-6 float-left">
                <?= session()->get('message'); ?>
            </div>
            <div class="card col-lg shadow">
                <div class="card-body col-lg-9">
                    <form action="<?= base_url('construction/energize/' . $customer['id_customer']); ?>" method="post" id="form-construction-log" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="customer" class="col-sm-3 col-form-label-sm">Customer</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="customer" name="customer" value="<?= $customer['name_customer']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ba_aco" class="col-sm-12 col-form-label-sm">Record of Installation and Connection ACO</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="form-control form-control-sm custom-file-input <?php if (isset($validation)) echo $validation->hasError('ba_aco') ? 'is-invalid' : ''; ?>" id="ba_aco" name="ba_aco[]" multiple>
                                    <label class="custom-file-label <?php if (isset($validation)) echo $validation->hasError('ba_aco') ? 'selected alert-danger' : ''; ?>" for="ba_aco">Choose file</label>
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ba_aco'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="working_order" class="col-sm-12 col-form-label-sm">Work Order</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="form-control form-control-sm custom-file-input <?php if (isset($validation)) echo $validation->hasError('working_order') ? 'is-invalid' : ''; ?>" id="working_order" name="working_order[]" multiple>
                                    <label class="custom-file-label <?php if (isset($validation)) echo $validation->hasError('working_order') ? 'selected alert-danger' : ''; ?>" for="working_order">Choose file</label>
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('working_order'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="images" class="col-sm-2 col-form-label-sm">Image</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="form-control form-control-sm custom-file-input <?php if (isset($validation)) echo $validation->hasError('images') ? 'is-invalid' : ''; ?>" id="images" name="images[]" multiple>
                                    <label class="custom-file-label <?php if (isset($validation)) echo $validation->hasError('images') ? 'selected alert-danger' : ''; ?>" for="images">Choose file</label>
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('images'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notes" class="col-sm-3 col-form-label-sm">Notes</label>
                            <div class="col-sm-10">
                                <textarea class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('notes') ? 'is-invalid' : ''; ?>" name="notes" id="notes" cols="30" rows="4" value="<?= set_value('notes'); ?>" placeholder="Type something here..."><?= set_value('notes'); ?></textarea>
                                <?php if (isset($validation)) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('notes'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group justify-content-end">
                            <div class="col-sm-10">
                                <button class="btn btn-primary" type="submit">
                                    Save
                                    <i class="fas fa-save ml-1 text-white"></i>
                                </button>
                                <a href="<?= base_url('construction'); ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script type="text/javascript">
    $(function() {
        var today = new Date();
        var year = today.getFullYear;

        $('#datetimepicker-datereport').datetimepicker({
            format: 'YYYY-MM-DD',
            todayHighlight: true,
            icons: {
                date: "fas fa-calendar-alt",
                today: "fas fa-calendar-check",
            },
            buttons: {
                showToday: true,
            },
        });

        $('#datetimepicker-starttime').datetimepicker({
            format: 'HH:mm',
        });

        $('#datetimepicker-endtime').datetimepicker({
            format: 'HH:mm',
        });
    });
</script>
<?= $this->endSection(); ?>