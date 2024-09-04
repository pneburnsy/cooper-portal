<div class="card card-top mb-4 col-12 col-lg-9">
    <div class="card-body" style="background:#fff;border-radius:10px;padding:0;">
        <div class="modals">
            <?php
            for ($x = 0; $x < count($menu_applications_all); $x++) {
                include 'modal/menu_applications_delete.php';
            }
            ?>
        </div>
        <form method="post">
            <div class="table-responsive menu_organiser">
                <table class="table align-middle datatable dt-responsive table-check nowrap">
                    <thead>
                    <th class="first-col"></th>
                    <th>Application Title</th>
                    <th>Application URL</th>
                    <th data-bs-toggle="tooltip" data-bs-placement="top" title="Positioned from lowest to highest in alphabetical order. Orders from 0-99.">Menu Order</th>
                    <th class="delete_only_cell"></th>
                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < count($menu_applications_all); $i++) { ?>
                        <tr class="menu-row <?= $menu_applications_all[$i]->uid ?>">
                            <input type="hidden" name="menu_uid[<?=$i?>]" class="d-none" value="<?= $menu_applications_all[$i]->uid ?>">
                            <td class="first-col"><span class="menu_number"><?= $i + 1 ?></span></td>
                            <td><input type="text" name="menu_name[<?=$i?>]" class="modal_input mobile_200" style="min-width:200px;" placeholder="Menu Name... *" value="<?= $menu_applications_all[$i]->menuname; ?>"></td>
                            <td><input type="url" name="menu_url[<?=$i?>]" class="modal_input mobile_200" style="min-width:200px;" placeholder="Application URL... *" value="<?= $menu_applications_all[$i]->menuurl; ?>"></td>
                            <td><input type="number" name="menu_order[<?=$i?>]" min="0" max="99" step="1" style="min-width:100px;" class="modal_input" placeholder="0" value="<?= $menu_applications_all[$i]->menuorder; ?>"></td>
                            <td class="delete_only_cell">
                                <button class="btn btn-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu_applications_delete_<?= $i; ?>" aria-controls="offcanvasRight">
                                    <i data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="mdi mdi-trash-can d-block font-size-14 mr-1"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div style="float: right; padding: 0 30px 30px 30px;">
                <button type="submit" name="menu_applications_edit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
            </div>
        </form>
    </div>
</div>
<div class="card card-top mb-4 col-12 col-lg-3">
    <div class="card-body" style="background:#fff;border-radius:10px;padding:30px;">
        <?= file_get_contents( 'assets/images/svg/new_package_menu.svg' ); ?>
        <h5>Add New Application +</h5>
        <p>Add URLs that Cooper Staff will be able to see for quick access to their applications.</p>
        <p class="small"><strong>Tip:</strong> Only admins can add, edit and delete these.</p>
        <form class="add_accounts" method="post">
            <label class="modal_label">Application Details</label>
            <input type="text" name="menu_name" class="modal_input" placeholder="Application Title *" required>
            <input type="url" name="menu_url" class="modal_input" placeholder="Application URL *" required>
            <input type="number" name="menu_order" min="0" max="99" step="1" class="modal_input" placeholder="Menu Order *" required>
            <button type="submit" name="menu_applications_add" class="btn btn-primary waves-effect waves-light mt-3">Add Application</button>
        </form>
    </div>
</div>