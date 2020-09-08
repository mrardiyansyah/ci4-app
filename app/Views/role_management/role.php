<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="col-lg">
            <div class="row">
                <?php if (isset($validation)) : ?>
                    <div class="alert alert-danger">
                        <?= $validation->getErrors(); ?>
                    </div>
                <?php endif; ?>

                <div>
                    <?= session()->get('message'); ?>
                </div>

                <div class="col-lg-3 mr-auto w-auto">
                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal"><i class="fas fa-user-plus"></i> Add Role</a>
                </div>
                <div class="col-lg-6 ml-auto w-auto">
                    <form action=" " method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search..." name="keyword">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <table class="table table-responsive-lg table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (5 * ($current_page - 1)); ?>
                    <?php foreach ($all_role as $r) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $r['role_type']; ?></td>
                            <td>
                                <a href="<?= base_url('admin/roleaccess/') . $r['id_role']; ?>" class="badge badge-primary">Access</a>
                                <!-- <a href="" class="badge badge-primary">Edit</a> -->
                                <a href="<?= base_url('admin/deleterole/') . $r['id_role']; ?>" class="badge btn-delete-role badge-danger">Delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>

                </tbody>
            </table>
            <?= $pager->links('user_role', 'lpremium_pagination'); ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/role'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>