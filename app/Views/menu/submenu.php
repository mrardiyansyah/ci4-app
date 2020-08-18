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
            <div class="pb-2">
                <a href="#" onclick="add_submenu()" class="btn btn-primary mb-3">Add New Sub Menu</a>
            </div>

            <table class="table table-hover table-striped table-submenu">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">ID SM</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($subMenu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $sm['title']; ?></td>
                            <td><?= $sm['menu']; ?></td>
                            <td><?= $sm['url']; ?></td>
                            <td><?= $sm['icon']; ?></td>
                            <td><?= $sm['id_user_sub_menu']; ?></td>
                            <td><?= $sm['is_active_menu']; ?></td>
                            <td>
                                <a href="#" onclick="edit_submenu(<?= $sm['id_user_sub_menu']; ?>)" class="badge badge-primary"">Edit</a>
                                <a href="" class=" badge badge-danger">Delete</a>
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


<!-- Modal Add Sub Menu -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="form-submenu" name="form-add-sm" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Sub menu title">
                    </div>
                    <div class="form-group">
                        <select name="id_user_menu" id="id_user_menu" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id_user_menu']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Sub menu url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub menu icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="hidden" value="0" id="is_active_menu" name="is_active_menu">
                            <input class="form-check-input" type="checkbox" value="1" id="is_active_menu1" name="is_active_menu" checked>
                            <label class="form-check-label" for="is_active_menu1">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.table-submenu').dataTable({
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
                'targets': [0, 4, 5, 6, 7],
                'searchable': false,
                'orderable': false
            }, {
                'targets': 3,
                'width': '100px'
            }],
        });

        $('#editSubMenuModal').on('show.bs.modal', function(e) {
            const id_SubMenu = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type: 'post',
                url: '<?= base_url('submenu/editSubMenu'); ?>',
                dataType: 'JSON',
                data: {
                    id: id_SubMenu,
                },
                success: function(data) {
                    console.log(data);
                    // $('.modal-data-submenu').html(data); //menampilkan data ke dalam modal
                }
            });
        });
    });
</script>

<script type="text/javascript">
    let save_method;

    function add_submenu() {
        save_method = 'add';
        $('#form-submenu').trigger("reset");
        $('#form-submenu').attr("action", '<?= base_url('submenu/add-submenu'); ?>');
        $('[id="btnSave"]').html("Add");
        $('#newSubMenuModal').modal('show');
        $('.modal-title').text('Add New Sub Menu');
    }

    function edit_submenu(id_submenu) {
        save_method = 'update';
        submenu = $('#form-submenu');
        submenu.attr("action", '<?= base_url('submenu/edit-submenu'); ?>');
        submenu.trigger("reset")
        <?php header('Content-type: application/json') ?>
        $.ajax({
            type: "post",
            url: "<?= base_url('submenu/editSubMenu'); ?>",
            dataType: "JSON",
            data: {
                id: id_submenu,
            },
            success: function(data) {
                // console.log(data);

                $('[name="title"]').val(data.title);
                $('[name="id_user_menu"]').val(data.id_user_menu);
                $('[name="url"]').val(data.url);
                $('[name="icon"]').val(data.icon);
                $('[id="btnSave"]').html("Edit");

                const check_active = data.is_active_menu;
                if (check_active != 1) {
                    $('[name="is_active_menu"]').prop('checked', false);
                }

                $('#newSubMenuModal').modal('show');
                $('.modal-title').text('Edit Sub Menu');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        $("#btnSave").click(function(e) {
            // e.preventDefault();
            $("#form-submenu").submit();
        });
    }
</script>


<?= $this->endSection(); ?>