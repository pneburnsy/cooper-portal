<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';
// PAGE
if ($_GET['page'] == 'completed') {
    $complete = 'Complete';
    $completed = 'Completed';
    $completestatus = true;
}

// HEADER
$page = $completed . ' Maintenance Contracts';
$breadcrumbtitle = $completed . ' Maintenance Contracts';
$breadcrumbchild = $completed . ' Renewals List';
include 'layouts/header.php';

// IMPORT QUERIES
doif_cooperonly(true, 'maintenance');

maintenance_all(false);
if ($completestatus) {
    maintenance_count(false, 1);
} else{
    maintenance_count(false);
}
maintenance_add(false);
maintenance_complete(false);
maintenance_uncomplete(false);
maintenance_bin(false);
accounts_team_distinct(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php include 'layouts/page_title.php'; ?>

<div class="row align-items-center table-header-block section-block mb-4">
    <div class="col-md-4">
        <div>
            <h5 class="card-title"><?= $completed ?> Maintenance Contracts List <span class="text-muted fw-normal ms-2">(<?= $maintenance_count ?>)</span></h5>
        </div>
    </div>
    <div class="col-md-8">
        <div class="button-group-mobile d-flex flex-wrap align-items-center justify-content-end gap-2">
            <?php form_clear_storage(); ?>
            <?php if ($_GET['page'] == 'completed') { ?>
                <a class="text-light" href="page_maintenance_contracts.php">
                    <button data-bs-toggle="tooltip" data-bs-placement="top" title="View all uncompleted maintenance contracts." class="btn btn-primary waves-effect waves-light" type="submit">
                        <i class="mdi mdi-eye d-inline-block font-size-16 ml-2" style="margin-right: 4px;"></i> View All Uncompleted
                    </button>
                </a>
            <?php } else { ?>
                <a class="text-light" href="page_maintenance_contracts.php?page=completed">
                    <button data-bs-toggle="tooltip" data-bs-placement="top" title="View all completed maintenance contracts." class="btn btn-primary waves-effect waves-light" type="submit">
                        <i class="mdi mdi-eye d-inline-block font-size-16 ml-2" style="margin-right: 4px;"></i> View All Completed
                    </button>
                </a>
            <?php } ?>
            <?php include 'layouts/includes/maintenance/modal/maintenance_team_add.php'; ?>
        </div>
    </div>
</div>

<?php maintenance_table($maintenance_all); ?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>
