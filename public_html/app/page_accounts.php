<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';
// HEADER
$page = 'Your Accounts';
$breadcrumbtitle = 'Accounts';
$breadcrumbchild = 'Accounts List';
include 'layouts/header.php';

// IMPORT QUERIES
doif_cooperadminonly(true, 'accounts');

accounts_team_all(false);
accounts_team_add(false);
accounts_team_count(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php include 'layouts/page_title.php'; ?>

<div class="row align-items-center table-header-block section-block mb-4">
    <div class="col-md-6">
        <div>
            <h5 class="card-title">Accounts List <span class="text-muted fw-normal ms-2">(<?= $accounts_team_count; ?>)</span></h5>
        </div>
    </div>
    <div class="col-md-6">
        <div class="button-group-mobile d-flex flex-wrap align-items-center justify-content-end gap-2">
            <?php form_clear_storage(); ?>
            <?php include 'layouts/includes/accounts/modal/accounts_team_add.php'; ?>
        </div>
    </div>
</div>

<?php accounts_table($accounts_team_all); ?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>
