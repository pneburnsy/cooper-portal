<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';
// HEADER
$page = 'Admin Options';
include 'layouts/header.php';
include 'layouts/page_title.php';

// IMPORT QUERIES
doif_cooperonly(true);

// IMPORT QUERIES
admin_edit(false);
$admin_table = $table = $table_name['admin'];
$adminoptions = $wpdb->get_results("SELECT * FROM $admin_table WHERE uid = 1");
?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php if ( current_user_can( 'administrator' ) ) { ?>

    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-12 p-0">
                <form class="update_accounts" method="post" enctype="multipart/form-data">
                    <div class="form-highlight">
                        <h4>Portal Admin Options</h4>
                        <p class="mb-4">These options will change the dashboard for all users, they are adjustable to administrators only.</p>
                        <div class="form-block">
                            <h5 class="modal_label">Portal Admin Contact</h5>
                            <label class="d-inline-block" style="margin-right:10px !important;width:fit-content;">These details will be displayed across the portal whenever it suggest to contact an admin. This email is also the recipient of all admin contact forms.</label>
                            <label class="d-block mt-3" style="margin-right:10px !important;width:fit-content;">Admin Name</label>
                            <input name="adminname" maxlength="60" type="text" class="modal_input last-list" id="adminname" placeholder="Admins Name..." value="<?= $adminoptions[0]->adminname; ?>">
                            <label class="d-block mt-2" style="margin-right:10px !important;width:fit-content;">Admin Email</label>
                            <input name="adminemail" maxlength="60" type="email" class="modal_input last-list" id="adminemail" placeholder="Admins Email Address..." value="<?= $adminoptions[0]->adminemail; ?>">
                        </div>
                        <div class="form-block">
                            <h5 class="modal_label">Portal Admin Reminders</h5>
                            <label name="portaladminemail" class="d-inline-block" style="margin-right:10px !important;width:fit-content;">Email all admin emails once a week with a status of all outstanding items.</label>
                            <input name="portaladminemail" type="email" multiple class="modal_input last-list" id="portaladminemail" placeholder="info@cooperhandling.com" value="<?= $adminoptions[0]->portaladminemail; ?>">
                        </div>
                        <div class="form-block">
                            <h5 class="modal_label">Portal Message</h5>
                            <label class="d-inline-block" style="margin-right:10px !important;width:fit-content;">Adds a message box across that is fixed at the bottom of the screen on all portal pages.</label>
                            <div class="d-inline-block flex-wrap gap-2" style="top:16px;position:relative;">
                                <input name="admin_message" type="checkbox" id="admin_message" switch="none" value="checked" <?php if ( $adminoptions[0]->messageswitch ) { echo 'checked'; } ?>>
                                <label for="admin_message" data-on-label="On" data-off-label="Off"></label>
                            </div>
                            <label for="message" class="d-block modal_label mt-4">Message (Max 200 Characters)</label>
                            <input name="message" maxlength="200" type="text" class="modal_input last-list" id="message" placeholder="Add your message here..." value="<?= $adminoptions[0]->message; ?>">
                            <label for="messageurl" class="d-block modal_label mt-4">Message Button URL (Max 40 Characters)</label>
                            <input name="messageurl" maxlength="200" type="url" class="modal_input last-list" id="messageurl" placeholder="Add URL here..." value="<?= $adminoptions[0]->messageurl; ?>">
                        </div>
                        <div class="form-block">
                            <h5 class="modal_label">Maintenance Mode</h5>
                            <label class="d-inline-block" style="margin-right:10px !important;width:fit-content;">The portal will only be accessible to people who are 'administrators' and no one else until this is switched off.</label>
                            <div class="d-inline-block flex-wrap gap-2" style="top: 16px;position: relative;">
                                <input name="admin_maintenance" type="checkbox" id="admin_maintenance" switch="none" value="checked" <?php if ( $adminoptions[0]->maintenanceswitch ) { echo 'checked'; } ?>>
                                <label for="admin_maintenance" data-on-label="On" data-off-label="Off"></label>
                            </div>
                        </div>
                        <button type="submit" name="admin_edit" class="btn btn-primary waves-effect waves-light mt-4" style="display:block;">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php } ?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>




<?php if ( current_user_can( 'administrator' ) ) { ?>


<?php } ?>
