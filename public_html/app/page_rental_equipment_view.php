<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';

// HEADER
$page = 'View Rentals Equipment';
$breadcrumbtitle = 'View Rentals Equipment';
include 'layouts/header.php';

// IMPORT QUERIES
doif_cooperonly(true, 'rental');

rentals_view(false);
rentals_edit(false);
rentals_complete(false);
rentals_reset(false);
rentals_history(false);
accounts_team_distinct(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php
if (!$rentals_view[0]->displayid) {
    include 'layouts/security/security_access_to_page.php';
} else {
    ?>
    <?= view_page_back('Rentals Equipment', '/app/page_rental_equipment.php'); ?>
    <?php accounts_team_single($rentals_view[0]->clientaccount, false); ?>
    <div class="card card-top section-block-mb2 section-block-p0 mb-4">
        <div class="card-body ">
            <div class="row">
                <div class="col-sm order-2 order-sm-1">
                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                        <div class="flex-shrink-0">
                            <div class="avatar-xl me-3">
                                <span class="profile-image-big"><?= $accounts_team_single[0]->accountname[0]; ?></span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div>
                                <h5 class="font-size-16 mb-1"><?= $rentals_view[0]->serial_no . ' (' . $rentals_view[0]->make . ' ' . $rentals_view[0]->model . ')'; ?></h5>
                                <p class="text-muted font-size-13">

                                    <?php
                                    if ($rentals_view[0]->hire_start) {
                                        $duename = renewal_due_check_advanced($rentals_view[0]->hire_start, $rentals_view[0]->hire_end)['name_rentals'];
                                        $duestatus = renewal_due_check_advanced($rentals_view[0]->hire_start, $rentals_view[0]->hire_end)['class'];
                                        if ($rentals_view[0]->hire_end) { $duevalue = formatted_renewal_date($rentals_view[0]->hire_end); } else { $duevalue = 'No End Date'; }
                                        $duesort = renewal_due_check_advanced($rentals_view[0]->hire_start, $rentals_view[0]->hire_end)['sort'];
                                    } else {
                                        $duename = 'Off-Hire';
                                        $duestatus = 'available';
                                        $duevalue = '-';
                                        $duesort = '6';
                                    }
                                    ?>

                                    <span style="position:relative;top:2px;">
                                        <strong>Hire Start:</strong> <?php if ($rentals_view[0]->hire_start) { echo formatted_date($rentals_view[0]->hire_start); } else { echo 'No Start Date'; } ?>
                                    </span>
                                    <br>
                                    <span style="position:relative;top:2px;">
                                        <strong>Hire End:</strong> <?php if ($rentals_view[0]->hire_end && strtotime($rentals_view[0]->hire_end) >= strtotime('1989-12-31') ) { echo formatted_date($rentals_view[0]->hire_end); } else { echo 'No End Date'; } ?>
                                    </span>
                                </p>
                                <div class="mb-3">
                                    <div style="margin-right: 12px;">
                                        <strong>Make: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $rentals_view[0]->make; ?></span>
                                    </div>
                                    <div style="margin-right: 12px;">
                                        <strong>Model: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $rentals_view[0]->model; ?></span>
                                    </div>
                                    <div style="margin-right: 12px;">
                                        <strong>Serial Number: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $rentals_view[0]->serial_no; ?></span>
                                    </div>
                                    <div style="margin-right: 12px;">
                                        <strong>Year: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $rentals_view[0]->year_of_man; ?></span>
                                    </div>
                                    <?php if (doif_coopereditoronly_query()) { ?>
                                        <div style="margin-right: 12px;">
                                            <strong>Finance Company: </strong>
                                            <span class=" text-muted font-size-13" style="margin-left: 3px;"><?php if ($rentals_view[0]->finance_company) { echo $rentals_view[0]->finance_company; } else { echo '-'; } ?></span>
                                        </div>
                                        <div style="margin-right: 12px;">
                                            <strong>Agreement Number: </strong>
                                            <span class=" text-muted font-size-13" style="margin-left: 3px;"><?php if ($rentals_view[0]->agreement_number) { echo $rentals_view[0]->agreement_number; } else { echo '-'; } ?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="region_profile d-inline-block" style="margin-right:12px;">
                                    <strong>Region: </strong>
                                    <?= get_region_flag($rentals_view[0]->region) ?>
                                </div>
                                <?php if ( $rentals_view[0]->clientaccount ) { ?>
                                    <div class="account_popup_container d-inline-block" style="margin-right: 12px;">
                                        <strong>Account: </strong>
                                        <a href="/app/page_accounts_view?displayid=<?= $accounts_team_single[0]->displayid; ?>">
                                            <span class="d-inline-block account_icon_full text-muted font-size-13" style="margin-left: 3px; background-color:rgba( <?= $accounts_team_single[0]->accountarray; ?> , 0.5)"><?= $accounts_team_single[0]->accountname; ?></span>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                <li class="nav-item account-icon">
                    <a class="nav-link px-3 <?php if (!$_GET['tab']) { echo 'active'; } ?>" data-bs-toggle="tab" href="#overview" role="tab">
                        <i data-feather="eye"></i>Overview
                    </a>
                </li>
                <?php if (doif_coopereditoronly_query()) { ?>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3 <?php if ($_GET['tab'] == 'renewal_settings') { echo 'active'; } ?>" data-bs-toggle="tab" href="#renewal_settings" role="tab">
                            <i data-feather="file-text"></i>Current Contract
                        </a>
                    </li>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3 <?php if ($_GET['tab'] == 'renewal_status') { echo 'active'; } ?>" data-bs-toggle="tab" href="#renewal_status" role="tab">
                            <i data-feather="edit-3"></i>Contract Status
                        </a>
                    </li>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3 <?php if ($_GET['tab'] == 'rentals_history') { echo 'active'; } ?>" data-bs-toggle="tab" href="#rentals_history" role="tab">
                            <i data-feather="list"></i>Contract History (<?= rentals_history_count(true); ?>)
                        </a>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </div>

    <div class="tab-content my-account-page section-block-p0 mb-4">
        <?php include 'layouts/includes/rentals/rentals_overview.php'; ?>
        <?php if (doif_coopereditoronly_query()) { ?>
            <?php include 'layouts/includes/rentals/rentals_edit.php'; ?>
            <?php include 'layouts/includes/rentals/rentals_status.php'; ?>
            <?php include 'layouts/includes/rentals/rentals_history.php'; ?>
        <?php } ?>
    </div>

    <?php
}
?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>