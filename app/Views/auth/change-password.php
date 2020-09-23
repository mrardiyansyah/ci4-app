<div class="container">

    <!--  Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
                                    <h5 class="mb-3"><?= session()->get('reset_email'); ?></h5>
                                </div>

                                <div>
                                    <?= session()->get('message'); ?>
                                </div>

                                <form class="user" method="POST" action="<?= base_url('reset-password') ?>">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Enter New Password...">
                                        <?php if (isset($validation)) : ?>
                                            <div class="text-danger pl-3" role="alert">
                                                <?= $validation->getError('password1'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password...">
                                        <?php if (isset($validation)) : ?>
                                            <div class="text-danger pl-3" role="alert">
                                                <?= $validation->getError('password2'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Change Password
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>