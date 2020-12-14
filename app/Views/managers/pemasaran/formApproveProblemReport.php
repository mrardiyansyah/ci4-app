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
                    <table class="table table-sm table table-borderless table-responsive">
                        <tbody>
                            <tr>
                                <th>Customer</th>
                                <th>:</th>
                                <td id="data-date"><?= $problem_report['name_customer']; ?></td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <th>:</th>
                                <td id="data-date"><?= localizedDateString($problem_report['date_report']); ?></td>
                            </tr>
                            <tr>
                                <th>Time</th>
                                <th>:</th>
                                <td id="data-time"><?= localizedTimeString($problem_report['start_time']); ?> - <?= localizedTimeString($problem_report['end_time']); ?></td>
                            </tr>
                            <tr>
                                <th>User</th>
                                <th>:</th>
                                <td id="data-user"><?= $problem_report['name']; ?></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <th>:</th>
                                <td id="data-description"><?= $problem_report['description']; ?></td>
                            </tr>
                            <tr>
                                <th>Suggestion Solution</th>
                                <th>:</th>
                                <td id="data-solution"><?= $problem_report['suggestion_solution']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <form action="<?= base_url('manager/pemasaran/approve-problem-report/' . $problem_report['id_user_cancellation']); ?>" method="post" id="form-problem-report-approve">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group" id="notes">
                            <label for="cancellation_notes" class="col-sm-3 col-form-label-sm font-weight-bold">Notes</label>
                            <div class="col-sm-10">
                                <textarea class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('cancellation_notes') ? 'is-invalid' : ''; ?>" name="cancellation_notes" id="cancellation_notes" cols="30" rows="4" value="<?= set_value('cancellation_notes'); ?>" placeholder="Type something here..."><?= set_value('cancellation_notes'); ?></textarea>
                                <?php if (isset($validation)) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('cancellation_notes'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group justify-content-end">
                            <div class="col-sm-10">
                                <button class="btn btn-sm btn-primary mb-1" type="submit">
                                    Submit
                                    <i class="fas fa-save ml-1 text-white"></i>
                                </button>
                                <a href="<?= base_url('manager/konstruksi'); ?>" class="btn btn-sm btn-secondary">Cancel</a>
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
</script>
<?= $this->endSection(); ?>