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
$page = $completed . ' Thorough Examinations';
$breadcrumbtitle = $completed . ' Thorough Examinations';
$breadcrumbchild = $completed . ' Renewals List';
include 'layouts/header.php';

// IMPORT QUERIES
doif_cooperonly(true, 'examinations');

exam_all(false);
if ($completestatus) {
    exam_count(false, 1);
} else{
    exam_count(false);
}
exam_complete(false);
exam_uncomplete(false);
exam_bin(false);
exam_add(true);
accounts_team_distinct(false);


?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php include 'layouts/page_title.php'; ?>

<div class="row align-items-center table-header-block section-block mb-4">
    <div class="col-md-4">
        <div>
            <h5 class="card-title"><?= $completed ?> Thorough Examinations List <span class="text-muted fw-normal ms-2">(<?= $exam_count; ?>)</span></h5>
        </div>
    </div>
    <div class="col-md-8">
        <div class="button-group-mobile d-flex flex-wrap align-items-center justify-content-end gap-2">
            <?php form_clear_storage(); ?>
            <?php if ($_GET['page'] == 'completed') { ?>
                <a class="text-light" href="page_thorough_examinations.php">
                    <button data-bs-toggle="tooltip" data-bs-placement="top" title="View all uncompleted thorough examinations." class="btn btn-primary waves-effect waves-light" type="submit">
                        <i class="mdi mdi-eye d-inline-block font-size-16 ml-2" style="margin-right: 4px;"></i> View All Uncompleted
                    </button>
                </a>
            <?php } else { ?>
                <a class="text-light" href="page_thorough_examinations.php?page=completed">
                    <button data-bs-toggle="tooltip" data-bs-placement="top" title="View all completed thorough examinations." class="btn btn-primary waves-effect waves-light" type="submit">
                        <i class="mdi mdi-eye d-inline-block font-size-16 ml-2" style="margin-right: 4px;"></i> View All Completed
                    </button>
                </a>
            <?php } ?>
            <?php include 'layouts/includes/renewals/modal/exam_add.php'; ?>
        </div>
    </div>
</div>

<?php thorough_examinations_table($exam_team_all); ?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>
