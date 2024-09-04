<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");

// SECURITY
include 'layouts/security.php';

// HEADER
$page = 'All Contacts';
$breadcrumbtitle = 'Dashboard';
$breadcrumbchild = 'All Contacts';
include 'layouts/header.php';

// IMPORT QUERIES
doif_cooperadminonly(true, 'contacts');

admin_all_users();
contacts_add(false);
contacts_status(false);

accounts_team_distinct(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php include 'layouts/page_title.php'; ?>

<div class="dashboard">
    <div class="row align-items-center table-header-block section-block mb-4">
        <div class="col-md-6">
            <div>
                <h5 class="card-title">All Contacts <span class="text-muted fw-normal ms-2">(<?= count($admin_all_users); ?>)</span></h5>
            </div>
        </div>
        <div class="col-md-6">
            <div class="button-group-mobile d-flex flex-wrap align-items-center justify-content-end gap-2">
                <?php form_clear_storage(); ?>
                <?php include 'layouts/includes/contacts/modal/contacts_add.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php user_table($admin_all_users, true); ?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>
