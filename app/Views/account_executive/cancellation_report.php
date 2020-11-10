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
            <div class="card col-lg">
                <div class="card-body col-lg-9">
                    <form action="<?= base_url('account-executive/cancellationReport/' . $customer['id_customer']); ?>" method="post" enctype="multipart/form-data" id="form-cancellation">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="customer" class="col-sm-3 col-form-label-sm">Customer</label>
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
                        <div class="form-group">
                            <label for="cancellation-reason" class="col-sm col-form-label-sm">Cancellation Reason</label>
                            <div class="col-sm-10">
                                <textarea class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('cancellation-reason') ? 'is-invalid' : ''; ?>" name="cancellation-reason" id="cancellation-reason" cols="30" rows="4" value="<?= set_value('cancellation-reason'); ?>" placeholder="Case Background and Reason to be Cancelled.."><?= set_value('cancellation-reason'); ?></textarea>
                                <?php if (isset($validation)) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('cancellation-reason'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="images" class="col-sm-4 col-form-label-sm">Image <span style="font-size: 80%;">(Optional)</span></label>
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
                        <div class="form-group mt-1 justify-content-end">
                            <div class="col-sm-10">
                                <button class="btn btn-primary mt-3" type="submit">
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
    });
</script>
<?= $this->endSection(); ?>