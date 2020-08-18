<!-- Modal Edit SubMenu -->
<div class="modal fade" name="editSubMenuModal" id="editSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="editSubMenuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubMenuLabel"> Edit Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submitEditsubmenu'); ?>" method="post" id="form-edit-sm" name="form-edit-sm">
                <div class="modal-body">
                    <!-- <div class="modal-data-submenu"> -->
                    <!-- <div class="modal-data-submenu"> -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Sub menu title" value="">
                    </div>
                    <div class="form-group">
                        <select name="id_user_menu" id="id_user_menu" class="form-control">
                            <option value="">Select Menu </option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id_user_menu']; ?>"></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Sub menu url" value="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub menu icon" value="">
                    </div>
                    <input type="hidden" value="" name="rowidsm">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active_submenu" value="1" name="is_active_submenu">
                            <label class="form-check-label" for="is_active_submenu">
                                Active?
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="form_type" name="form_type" value="edit-submenu">
                    </div>
                    <!-- </div> -->
                    <!-- </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="Submit" class="btn btn-primary" id="edit-data-submenu" name="edit-data-submenu">Edit Data</button>
                </div>
            </form>
        </div>
    </div>
</div>