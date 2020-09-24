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
                                <a href="#" class="btn btn-sm btn-primary"><i class="far fa-fw fa-eye"></i></a>
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
        $('.table-customer').dataTable({
            'destroy': true,
            'responsive': true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            'scrollY': '350px',
            'scrollX': true,
            'scrollCollapse': true,
            'fixedColumns': true,
            'order': [
                [1, "asc"]
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