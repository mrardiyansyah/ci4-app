<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <div class="col-lg-6">
                <?= session()->get('message'); ?>
            </div>
            <table class="table table-hover table-reksis" style="width: 100%;">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">ID</th>
                        <th scope="col">Tarif / Daya</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Informasi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($request_reksis as $c) : ?>
                        <tr class="table-light">
                            <th scope="row" class="text-center"><?= $i; ?></th>
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
                                <form action="<?= base_url('planning/request-potential/' . $c['id_customer']); ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-primary btn-submit-reksis" data-toggle="tooltip" data-placement="bottom" data-id="<?= $c['id_customer']; ?>" data-url="<?= base_url('planning/'); ?>" data-information="<?= $c['information']; ?>" title="Upload Reksis for <?= $c['name_customer']; ?>"><i class="fas fa-fw fa-file-upload"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    $(document).ready(function() {
        $('.table-reksis').dataTable({
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
                'width': '120px'
            }, {
                'targets': 6,
                'width': "161px"
            }],
        });
    });
</script>

<?= $this->endSection(); ?>