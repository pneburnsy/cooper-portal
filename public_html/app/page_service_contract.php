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
$page = $completed . ' Service Planner';
$breadcrumbtitle = $completed . ' Service Planner';
$breadcrumbchild = $completed . ' Service List';
include 'layouts/header.php';

// IMPORT QUERIES
doif_cooperonly(true, 'service');

service_all(false);
service_add(false);
service_complete(false);
service_uncomplete(false);
service_bin(false);
if ($completestatus) {
    service_count(false, 1);
} else {
    service_count(false);
}
accounts_team_distinct(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php include 'layouts/page_title.php'; ?>

<div class="row align-items-center table-header-block section-block mb-4">
    <div class="col-md-4">
        <div>
            <h5 class="card-title"><?= $completed ?> Service Planner List <span class="text-muted fw-normal ms-2">(<?= $service_count; ?>)</span></h5>
        </div>
    </div>
    <div class="col-md-8">
        <div class="button-group-mobile d-flex flex-wrap align-items-center justify-content-end gap-2">
            <?php form_clear_storage(); ?>
            <?php if ($_GET['page'] == 'completed') { ?>
                <a class="text-light" href="page_service_contract.php">
                    <button data-bs-toggle="tooltip" data-bs-placement="top" title="View all uncompleted maintenance contracts." class="btn btn-primary waves-effect waves-light" type="submit">
                        <i class="mdi mdi-eye d-inline-block font-size-16 ml-2" style="margin-right: 4px;"></i> View All Uncompleted
                    </button>
                </a>
            <?php } else { ?>
                <a class="text-light" href="page_service_contract.php?page=completed">
                    <button data-bs-toggle="tooltip" data-bs-placement="top" title="View all completed maintenance contracts." class="btn btn-primary waves-effect waves-light" type="submit">
                        <i class="mdi mdi-eye d-inline-block font-size-16 ml-2" style="margin-right: 4px;"></i> View All Completed
                    </button>
                </a>
            <?php } ?>
            <?php if ( current_user_can( 'administrator' ) ) { ?>
                <?php include 'layouts/includes/service/modal/service_add.php'; ?>
            <?php } ?>
        </div>
    </div>
</div>

<?php service_table($service_all); ?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>



