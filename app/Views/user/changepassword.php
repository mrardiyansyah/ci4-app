<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-6">

            <?= session()->get('message'); ?>

            <form action="<?= base_url('change-password'); ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="password" class="col-form-label col-form-label-sm">Current Password</label>
                    <div class="input-group input-group-sm">
                        <input type="password" class="form-control form-control-sm border-right-0
                         <?php if (isset($validation)) echo ($validation->hasError('current_password') ? 'is-invalid' : ''); ?>" id="password" name="current_password">
                        <div class="input-group-prepend">
                            <div class="input-group-text input-group-addon border-left-0 bg-transparent <?php if (isset($validation)) echo ($validation->hasError('current_password') ? 'is-invalid' : ''); ?>">
                                <a href="#" class="" id="icon-show-password" data-toggle="tooltip" data-placement="right" title="Show Password">
                                    <i class="fas fa-fw fa-eye text-secondary" id="icon"></i>
                                </a>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            <?php if (isset($validation)) echo $validation->getError('current_password'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_password1" class="col-form-label col-form-label-sm">New Password</label>
                    <input type="password" class="form-control form-control-sm <?php if (isset($validation)) echo ($validation->hasError('new_password1') ? 'is-invalid' : ''); ?>" id="new_password1" name="new_password1">
                    <div class="invalid-feedback d-block">
                        <?php if (isset($validation)) echo $validation->getError('new_password1'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_password2" class="col-form-label col-form-label-sm ">Repeat Password</label>
                    <input type="password" class="form-control form-control-sm <?php if (isset($validation)) echo ($validation->hasError('new_password2') ? 'is-invalid' : ''); ?> " id="new_password2" name="new_password2">
                    <div class="invalid-feedback d-block">
                        <?php if (isset($validation)) echo $validation->getError('new_password2'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>