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
                                    <h1 class="h4 text-gray-900 mb-4">Login Page</h1>
                                </div>
                                <?= session()->get('message'); ?>
                                <form class="user" method="post" action="<?= base_url('login') ?>">
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                                            <?php if (isset($validation)) : ?>
                                                <div class="text-danger pl-3" role="alert">
                                                    <?= $validation->getError('email'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                                <div class="input-group-prepend">
                                                    <div class="btn-outline-primary input-group-text rounded-left" style="border-radius: 10rem; background-color: #FFFFFF;">
                                                        <a href="#" id="icon-show-password" data-toggle="tooltip" data-placement="right" title="Show Password">
                                                            <i class="fas fa-eye" id="icon"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if (isset($validation)) : ?>
                                                <div class="text-danger pl-3" role="alert">
                                                    <?= $validation->getError('password'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('forgot-password'); ?>">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('signup'); ?>">Create an Account!</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>