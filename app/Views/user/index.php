<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= session()->get('message'); ?>
        </div>
    </div>

    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4" style="max-width: 187px;max-height: 187px;">

                <?php if ($user['image'] == 'default.jpg') { ?>
                    <img src="<?= base_url('assets/img/profile/' . $user['image']); ?>" class="card-image img-thumbnail ">
                <?php } else { ?>
                    <img src="<?= base_url('assets/img/profile/' . $user['id_user'] . '/' . $user['image']); ?>" class="card-img">
                <?php } ?>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['name']; ?></h5>
                    <p class="card-text">Email : <?= $user['email']; ?></p>
                    <p class="card-text">Role : <?= $role['role_type']; ?></p>
                    <p class="card-text"><small class="text-muted">Member Since : <?= date('d F Y', strtotime($user['created_at'])); ?></small></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?= $this->endSection(); ?>