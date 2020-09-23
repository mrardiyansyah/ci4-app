<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <?php if (isset($validation)) : ?>
                <div class="alert alert-danger">
                    <?= $validation->listErrors(); ?>
                </div>
            <?php endif; ?>

            <div>
                <?= session()->get('message'); ?>
            </div>
            <!-- <div class="pb-2">
                <a href="#" onclick="add_submenu()" class="btn btn-primary mb-3" data-toggle="tooltip" data-placement="right" title="Add New Sub Menu">Add New Sub Menu</a>
            </div> -->

            <table class="table table-hover table-responsive table-all-user">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Image</th>
                        <th scope="col">Active</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($all_user as $acc) : ?>
                        <tr>
                            <td class="number"><?= $i; ?></td>
                            <td><?= $acc['name']; ?></td>
                            <td><?= $acc['email']; ?></td>
                            <td><?= $acc['role_type']; ?></td>
                            <td>
                                <img src="<?= base_url('assets/img/profile/' . $acc['image']); ?>" class="img-fluid text-center" style="max-width: 50px; height: auto;">
                            </td>
                            <td class="text-center"><?= $acc['is_active']; ?></td>
                            <td><?= change_format_date($acc['created_at']); ?></td>
                            <td>
                                <a href="<?= base_url('admin/detail-user/' . $acc['id_user']); ?>" class="btn btn-sm btn-primary"><i class="far fa-fw fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php $i++ ?>
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
        $('.table-all-user').dataTable({
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
                [0, "asc"]
            ],
            'columnDefs': [{
                'targets': [0, 4, 7],
                'searchable': false,
                'orderable': false
            }, {
                'targets': 3,
                'width': '50px'
            }],
        });
    });
</script>

<?= $this->endSection(); ?>