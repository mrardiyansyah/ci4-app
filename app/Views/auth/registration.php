<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('signup'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?= set_value('name'); ?>">
                                <?php if (isset($validation)) : ?>
                                    <div class="text-danger pl-3" role="alert">
                                        <?= $validation->getError('name'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class=" form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                                <?php if (isset($validation)) : ?>
                                    <div class="text-danger pl-3" role="alert">
                                        <?= $validation->getError('email'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class=" form-group">
                                <select class="form-control" id="role_type" name="role_type" style="border-radius:10rem; font-size:.8rem; height:3rem;">
                                    <option value="" selected disabled>Role Type</option>
                                    <?php foreach ($role as $r) : ?>
                                        <option style="padding: 1.5rem 1rem;" <?= set_select('role_type', $r['id_role']); ?> value="<?= $r['id_role'] ?>"><?= $r['role_type']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($validation)) : ?>
                                    <div class="text-danger pl-3" role="alert">
                                        <?= $validation->getError('role_type'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <?php if (isset($validation)) : ?>
                                    <div class="text-danger pl-3" role="alert">
                                        <?= $validation->getError('password1'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('login'); ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>