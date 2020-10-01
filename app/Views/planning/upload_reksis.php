<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col col-lg">
            <?= session()->get('message'); ?>

            <form action="<?= base_url('planning/request-potential/' . $customer['id_customer']); ?>" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group row">
                            <label for="name_customer" class="col-sm-2 col-form-label-sm">Customer</label>
                            <div class="col-sm-6" data-toggle="tooltip" data-placement="right" title="Name Customer can't be changed">
                                <input type="text" class="form-control" id="name_customer" name="name_customer" value="<?= $customer['name_customer']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reksisSLD" class="col-sm-2 col-form-label-sm">Reksis + SLD</label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control custom-file-input <?php if (isset($validation)) echo $validation->hasError('reksisSLD') ? 'is-invalid' : ''; ?>" id="reksisSLD" name="reksisSLD[]" multiple>
                                <label class="custom-file-label <?php if (isset($validation)) echo $validation->hasError('reksisSLD') ? 'selected alert-danger' : ''; ?>" for="reksisSLD">Choose File</label>
                                <?php if (isset($validation)) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('reksisSLD'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <button class="btn btn-sm btn-primary" type="submit" name="uploadReksisSLD" id="uploadReksisSLD">
                                    Upload
                                    <i class="fas fa-upload ml-1 text-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>