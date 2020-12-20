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
                                <td class="text-info font-weight-bold" id="data-date"><?= $problem_report['name_customer']; ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <th>:</th>
                                <td class="badge <?= $problem_report['badge_status']; ?>" id="data-status"><?= $problem_report['status']; ?></td>
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
                                <th>Reported By</th>
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
                                <td id="data-solution"><?= $problem_report['suggestion_solution'] ?? '-'; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <form action="#" method="post" id="form-problem-report">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="status" class="col-sm-3 col-form-label-sm font-weight-bold">Choose Status</label>
                            <div class="col-sm-10">
                                <select id="approval_status" name="approval_status" class="form-control custom-select-sm <?php if (isset($validation)) echo $validation->hasError('approval_status') ? 'is-invalid' : ''; ?>">
                                    <option value="" selected hidden>Please Choose...</option>
                                    <?php foreach ($list_status as $uc) : ?>
                                        <?php if ($uc['id_approval_status'] == 3 || $uc['id_approval_status'] == 5) : ?>
                                            <option value="<?= $uc['id_approval_status'] ?>" <?= set_select('approval_status', $uc['id_approval_status']); ?>><?= $uc['approval_status'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($validation)) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('approval_status'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group" id="problem-solution">
                            <label for="solutions" class="col-sm-3 col-form-label-sm font-weight-bold">Solution</label>
                            <div class="col-sm-10">
                                <textarea class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('solutions') ? 'is-invalid' : ''; ?>" name="solutions" id="solutions" cols="30" rows="4" value="<?= set_value('solutions'); ?>" placeholder="Type something here..."><?= set_value('solutions'); ?></textarea>
                                <?php if (isset($validation)) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('solutions'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group justify-content-end">
                            <div class="col-sm-10">
                                <button class="btn btn-sm btn-primary btn-submit-problem-report mb-1" type="submit" data-id="<?= $problem_report['id_user_cancellation']; ?>" data-status="<?= $problem_report['status']; ?>" data-url="<?= base_url('manager'); ?>">
                                    Submit
                                    <i class="fas fa-save ml-1 text-white"></i>
                                </button>
                                <a href="<?= base_url(''); ?>" class="btn btn-sm btn-secondary btn-cancel">Cancel</a>
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
    $(document).ready(function() {
        approval_status = $("select#approval_status")
        let selectedStatus = approval_status.children("option:selected").val();
        if (!selectedStatus || selectedStatus == 3) {
            $("#problem-solution").hide();
        }

        approval_status.change(function() {
            let selectedStatus = approval_status.children("option:selected").val();
            if (selectedStatus == 5) {
                // alert("You have selected the country -  asu" + selectedStatus);
                $("#problem-solution").show(500);
            } else {
                $("#problem-solution").hide(500);
                // alert("You have selected the country -  asu" + selectedStatus);
            }
        });
    });
</script>
<?= $this->endSection(); ?>