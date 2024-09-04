<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';
// HEADER
$page = 'Rental Equipment';
$breadcrumbtitle = 'Rental Equipment';
$breadcrumbchild = 'Renewals List';
include 'layouts/header.php';

// IMPORT QUERIES
doif_cooperonly(true, 'rental');

rentals_all(false);
rentals_count(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php include 'layouts/page_title.php'; ?>

<div class="row align-items-center table-header-block section-block mb-4">
    <div class="col-md-4">
        <div>
            <h5 class="card-title">Rental Equipment List <span class="text-muted fw-normal ms-2">(<?= $rentals_count; ?>)</span></h5>
        </div>
    </div>
    <div class="col-md-8">
        <div class="button-group-mobile d-flex flex-wrap align-items-center justify-content-end gap-2">
            <?php form_clear_storage(); ?>
            <?php //include 'layouts/includes/accounts/modal/accounts_team_add.php'; ?>
        </div>
    </div>
</div>

<?php rentals_table($rentals_team_all); ?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>
