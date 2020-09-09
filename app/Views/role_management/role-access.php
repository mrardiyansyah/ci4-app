<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?php if (isset($validation)) : ?>
                <div class="alert alert-danger">
                    <?= $validation->getErrors(); ?>
                </div>
            <?php endif; ?>

            <div>
                <?= session()->get('message'); ?>
            </div>

            <h5>Role : <?= $role['role_type']; ?></h5>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">ID Role</th>
                        <th scope="col">ID User Menu</th>
                        <th scope="col">Access</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['menu']; ?></td>
                            <td><?= $role['id_role']; ?></td>
                            <td><?= $m['id_user_menu']; ?></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" name="check_access_role" type="checkbox" <?= check_access($role['id_role'], $m['id_user_menu']); ?> data-role="<?= $role['id_role']; ?>" data-menu="<?= $m['id_user_menu']; ?>">
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

<script type="text/javascript">
    $('[name="check_access_role"]').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/change-access'); ?>",
            type: 'POST',
            data: {
                // Objek Data: Variable yang sudah diambil
                menuId: menuId,
                roleId: roleId
            },
            success: function(data) {
                alert(data);
            }
        });
    });
</script>

<?= $this->endSection(); ?>