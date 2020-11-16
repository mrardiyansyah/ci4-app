<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col col-lg">
            <div class="col-lg-6 float-left">
                <?= session()->get('message'); ?>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('account-executive/working-order/' . $customer['id_customer']); ?>" method="post" enctype="multipart/form-data" id="form-working-order">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="customer" class="col-sm-3 col-form-label-sm">Customer</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm" id="customer" name="customer" value="<?= $customer['name_customer']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="working_order" class="col-sm col-form-label-sm">File Working Order</label>
                            <div class="col-sm-6">
                                <div class="custom-file">
                                    <input type="file" class="form-control custom-file-input <?php if (isset($validation)) echo $validation->hasError('working_order') ? 'is-invalid' : ''; ?>" id="working_order" name="working_order[]" multiple>
                                    <label class="custom-file-label <?php if (isset($validation)) echo $validation->hasError('working_order') ? 'selected alert-danger' : ''; ?>" for="working_order">Choose file</label>
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('working_order'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group justify-content-end">
                            <div class="col-sm-10">
                                <button class="btn btn-sm btn-primary" type="submit" name="uploadSPJBTL" id="uploadSPJBTL">
                                    Upload
                                    <i class="fas fa-upload ml-1 text-white"></i>
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

<?= $this->endSection(); ?>