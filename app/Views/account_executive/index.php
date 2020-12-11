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
            <table class="table table-bordered table-hover table-striped table-customer" style="width: 100%;">
                <thead class="thead-dark">
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
                                <div class="tooltip-wrapper" data-toggle="tooltip" data-placement="left" data-original-title="See Detail Customer">
                                    <a href="<?= base_url('account-executive/detail/' . $c['id_customer']); ?>" class="btn btn-sm btn-information btn-info"><i class="fas fa-fw fa-info"></i></a>
                                </div>
                                <div class="tooltip-wrapper pt-1" data-toggle="tooltip" data-placement="left" data-original-title="#">
                                    <a href="#" class="btn btn-sm btn-salesman btn-primary" data-id="<?= $c['id_customer']; ?>" data-information="<?= $c['information']; ?>" data-url="<?= base_url('account-executive'); ?>"><i class="far fa-fw fa-edit"></i></a>
                                </div>
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
        $('.table-customer').DataTable({
            'destroy': true,
            'responsive': true,
            'pageLength': -1,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            'scrollY': '350px',
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
                'targets': [2, 3],
                'width': '85px'
            }, {
                'targets': 6,
                'width': "161px"
            }],
        });
    });
</script>
<script src="<?= base_url('assets/js/btnSalesman.js'); ?>"></script>

<?= $this->endSection(); ?>