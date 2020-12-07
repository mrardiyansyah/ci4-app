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
                    <table class="table table-sm table-borderless table-responsive">
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
                    <form action="<?= base_url('construction/problem-solved/' . $problem_report['id_user_cancellation']); ?>" method="post" id="form-problem-report" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="status" class="col-sm-3 col-form-label-sm font-weight-bold">Choose Status</label>
                            <div class="col-sm-10">
                                <select id="approval_status" name="approval_status" class="form-control custom-select-sm">
                                    <option value="" disabled selected hidden>Please Choose...</option>
                                    <?php foreach ($list_status as $uc) : ?>
                                        <?php if ($uc['id_approval_status'] == 3 || $uc['id_approval_status'] == 5) : ?>
                                            <option value="<?= $uc['id_approval_status'] ?>" <?= set_select('approval_status', $uc['id_approval_status']); ?>><?= $uc['approval_status'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($validation)) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('status'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group hide" id="problem-solution">
                            <label for="description" class="col-sm-3 col-form-label-sm font-weight-bold">Solution</label>
                            <div class="col-sm-10">
                                <textarea class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('description') ? 'is-invalid' : ''; ?>" name="description" id="description" cols="30" rows="4" value="<?= set_value('description'); ?>" placeholder="Type something here..."><?= set_value('description'); ?></textarea>
                                <?php if (isset($validation)) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('description'); ?>
                                    </div>
                                <?php endif; ?>
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
        $("select#approval_status").change(function() {
            let selectedStatus = $(this).children("option:selected").val();
            if (selectedStatus == 3) {
                alert("You have selected the country -  asu" + selectedStatus);
                $("#problem-solution").addClass('hide');
            } else {
                $("#problem-solution").removeClass('hide');
                alert("You have selected the country -  asu" + selectedStatus);
            }
        });
    });
</script>
<?= $this->endSection(); ?>