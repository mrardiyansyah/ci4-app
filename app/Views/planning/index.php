<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <div class="col-lg-9">
                <?= session()->get('message'); ?>
            </div>

            <!-- Tabel Customer -->
            <table class="table table-hover table-customer" style="width: 100%;">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">ID Pel</th>
                        <th scope="col">Tarif / Daya</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Informasi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($customer as $c) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $c['name_customer']; ?></td>
                            <td class="text-center"><?= $c['id_pelanggan'] ?? "Not Defined"; ?></td>
                            <td class="text-center"><?= $c['tariff']; ?> / <?= $c['power']; ?></td>
                            <td class="text-center">
                                <span class="badge <?= $c['badge']; ?>">
                                    <?= $c['type_of_service']; ?>
                                </span>
                            </td>
                            <td class="text-center"><?= $c['status']; ?></td>
                            <td class="text-center"><?= $c['information']; ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('planning/detail-customer/' . $c['id_customer']); ?>" class="btn btn-sm btn-primary"><i class="far fa-fw fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- List Account Executive -->
            <div class="col-lg-4 mt-2 mb-2">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <span class="float-right font-weight-bold text-primary" title="<?= count($list_ae); ?> Account Executive"><?= count($list_ae); ?></span>
                        <h6 class="m-0 font-weight-bold text-primary">Account Executive</h6>
                    </div>
                    <div class="card-body" style="max-height: 370px; overflow-y: auto;">
                        <?php foreach ($list_ae as $ae) : ?>
                            <span class="float-right text-cadetblue small font-weight-bolder" data-toggle="tooltip" title="Have <?= ($ae['total'] > 0) ? $ae['total'] : 'No'; ?> Potential Customer"><i class="fas fa-user-friends"></i> <?= $ae['total']; ?></span>
                            <div class="row mb-4">
                                <div class="">
                                    <?php if ($ae['image'] == 'default.jpg') { ?>
                                        <img class="img-fluid rounded-circle" src="<?= base_url('assets/img/profile/' . $ae['image']); ?>" width="35" height="35">
                                    <?php } else { ?>
                                        <img class="img-fluid rounded-circle" src="<?= base_url('assets/img/profile/' . $ae['id_user'] . '/' . $ae['image']); ?>" width="35" height="35">
                                    <?php } ?>
                                </div>
                                <div class="col">
                                    <div class="list-heading">
                                        <span class="ml-1 small font-weight-bold"><?= $ae['name']; ?> </span>
                                    </div>
                                    <div class="list-subheading">
                                        <span class="ml-1 text-gray-500 small"><?= $ae['role_type']; ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    $(document).ready(function() {
        $('.table-customer').dataTable({
            'destroy': true,
            'responsive': true,
            "pageLength": -1,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            'scrollY': '240px',
            'scrollX': true,
            'scrollCollapse': true,
            'fixedColumns': true,
            'order': [
                [2, "asc"]
            ],
            'columnDefs': [{
                'targets': [0],
                'searchable': false,
                'orderable': false
            }, {
                'targets': 3,
                'width': '83px'
            }, {
                'targets': 6,
                'width': "161px"
            }],
        });
    });
</script>

<?= $this->endSection(); ?>