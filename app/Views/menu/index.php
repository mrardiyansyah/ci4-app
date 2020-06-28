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
                    <?= $validation->getError(); ?>
                </div>
            <?php endif; ?>

            <div>
                <?= session()->get('message'); ?>
            </div>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['menu']; ?></td>
                            <td>
                                <a href="" id="edit" class="edit-btn badge badge-primary" data-toggle="modal" data-target="#edit-menu" data-id="<?= $m['id_user_menu']; ?>" data-menu="<?= $m['menu']; ?>">Edit</a>
                                <a href="<?= base_url('menu/delete-menu') . '/' . $m['id_user_menu']; ?>" id="delete" class="badge badge-danger btn-hapus-menu" data-swal="swal" data-menu="<?= $m['menu']; ?>">Delete</a>
                                <a href="#" id="testSwal" class=" badge badge-secondary" data-swal="swal" data-menu="<?= $m['menu']; ?>">Edit</a>
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

<!-- Modal -->


<!-- Modal Add New Menu -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
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

<!-- Modal Edit Menu -->
<div class="modal fade" id="edit-menu" tabindex="-1" role="dialog" aria-labelledby="edit-menu" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-dark font-weight-bolder" id="edit-menu">Edit Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/edit-menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id_menu" name="id_menu">
                        <input type="text" class="form-control" id="menu-name" name="menu-name" placeholder="Menu name" require>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.edit-btn').on('click', function() {
            let id_user_menu = $(this).data('id');
            let menu = $(this).data('menu');
            $('#id_menu').val(id_user_menu);
            $('#menu-name').val(menu);
        });
    });
</script>

<?= $this->endSection(); ?>