<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <a href="<?= base_url('accountexecutive/cancellationReport/' . $customer['id_customer']); ?>" class="btn btn-sm btn-danger mb-3 ml-1 float-right btn-confirm-rejected"><i class="fas fa-times text-white"></i> Rejected</a>
            <a href="<?= base_url('accountexecutive/closing/' . $customer['id_customer']); ?>" class="btn btn-sm btn-warning mb-3 float-right btn-confirm-closing"><i class="far fa-handshake text-white"></i> Closing</a>
            <div class="col-lg-6 float-left">
                <?= session()->get('message'); ?>
            </div>
            <div class="card col-lg">
                <div class="card-body col-lg-9">
                    <form action="<?= base_url('account-executive/save-probing/' . $customer['id_customer']); ?>" method="post" id="form-probing" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="customer" class="col-sm-2 col-form-label-sm">Customer</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="customer" name="customer" value="<?= $customer['name_customer']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_report" class="col-sm-2 col-form-label-sm">Date</label>
                            <div class="col-sm-5">
                                <div class="input-group date" id="datetimepicker-datereport" data-target-input="nearest">
                                    <input type="text" class="form-control form-control-sm datepicker datetimepicker-input <?php if (isset($validation)) echo $validation->hasError('date_report') ? 'is-invalid' : ''; ?>" data-toggle="datetimepicker" data-target="#datetimepicker-datereport" name="date_report" id="date_report" value="<?= set_value('date_report'); ?>" placeholder="DD-MM-YYYY" />
                                    <div class="input-group-append" data-target="#datetimepicker-datereport" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                    </div>
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('date_report'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="start_time" class="col-sm col-form-label-sm">Start</label>
                                <div class="col-sm">
                                    <div class="input-group date" id="datetimepicker-starttime" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-sm datepicker datetimepicker-input <?php if (isset($validation)) echo $validation->hasError('start_time') ? 'is-invalid' : ''; ?>" data-toggle="datetimepicker" data-target="#datetimepicker-starttime" name="start_time" id="start_time" value="<?= set_value('start_time'); ?>" placeholder="<?= date("H:i"); ?>" />
                                        <div class="input-group-append" data-target="#datetimepicker-starttime" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                        <?php if (isset($validation)) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('start_time'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="end_time" class="col-sm col-form-label-sm">End</label>
                                <div class="col-sm">
                                    <div class="input-group date" id="datetimepicker-endtime" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-sm datepicker datetimepicker-input <?php if (isset($validation)) echo $validation->hasError('end_time') ? 'is-invalid' : ''; ?>" data-toggle="datetimepicker" data-target="#datetimepicker-endtime" name="end_time" id="end_time" value="<?= set_value('end_time'); ?>" placeholder="<?= date("H:i"); ?>">
                                        <div class="input-group-append" data-target="#datetimepicker-endtime" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                        <?php if (isset($validation)) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('end_time'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="discussed" class="col-sm-2 col-form-label-sm">Discussed</label>
                            <div class="col-sm-10">
                                <textarea class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('discussed') ? 'is-invalid' : ''; ?>" name="discussed" id="discussed" cols="30" rows="4" value="<?= set_value('discussed'); ?>" placeholder="Type something here..."><?= set_value('discussed'); ?></textarea>
                                <?php if (isset($validation)) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('discussed'); ?>
                                    </div>
                                <?php endif; ?>
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
                        <div class="form-group justify-content-end">
                            <div class="col-sm-10">
                                <button class="btn btn-primary" type="submit">
                                    Save
                                    <i class="fas fa-save ml-1 text-white"></i>
                                </button>
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