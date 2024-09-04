<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';

// HEADER
$page = 'View Thorough Examinations';
$breadcrumbtitle = 'View Thorough Examinations';
include 'layouts/header.php';

// IMPORT QUERIES
doif_cooperonly(true, 'examinations');

exam_view(false);
exam_edit(false);
exam_bin(false);
accounts_team_distinct(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php
if (!$exam_view[0]->displayid) {
    include 'layouts/security/security_access_to_page.php';
} else {
    ?>
    <?= view_page_back('Thorough Examinations', '/app/page_thorough_examinations.php'); ?>
    <?php accounts_team_single($exam_view[0]->clientaccount, false); ?>
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
                                <h5 class="font-size-16 mb-1"><?= $exam_view[0]->serial_no . ' (' . $exam_view[0]->make . ' ' . $exam_view[0]->model . ')'; ?></h5>
                                <p class="text-muted font-size-13">
                                    <?php $duename = renewal_due_check($exam_view[0]->renewal_date)['name'];
                                    $duestatus = renewal_due_check($exam_view[0]->renewal_date)['class']; ?>
                                    <span style="position:relative;top:2px;">
                                        <strong>Renewal Date:</strong> <?= formatted_renewal_date($exam_view[0]->renewal_date); ?>
                                    </span>
                                </p>
                                <div class="mb-3">
                                    <div style="margin-right: 12px;">
                                        <strong>Make: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $exam_view[0]->make; ?></span>
                                    </div>
                                    <div style="margin-right: 12px;">
                                        <strong>Model: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $exam_view[0]->model; ?></span>
                                    </div>
                                    <div style="margin-right: 12px;">
                                        <strong>Fleet Number: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $exam_view[0]->fleet_no; ?></span>
                                    </div>
                                    <div style="margin-right: 12px;">
                                        <strong>Serial Number: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $exam_view[0]->serial_no; ?></span>
                                    </div>
                                    <div style="margin-right: 12px;">
                                        <strong>Year: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $exam_view[0]->year_of_man; ?></span>
                                    </div>
                                </div>
                                <div class="region_profile d-inline-block" style="margin-right: 12px;">
                                    <strong>Region:</strong>
                                    <?= get_region_flag($exam_view[0]->region) ?>
                                </div>
                                <?php if ( $exam_view[0]->clientaccount ) { ?>
                                    <div class="account_popup_container d-inline-block" style="margin-right: 12px;">
                                        <strong>Account: </strong>
                                        <a href="/app/page_accounts_view?displayid=<?= $accounts_team_single[0]->displayid; ?>">
                                            <span class="d-inline-block account_icon_full text-muted font-size-13" style="margin-left: 3px; background-color:rgba( <?= $accounts_team_single[0]->accountarray; ?> , 0.5)"><?= $accounts_team_single[0]->accountname; ?></span>
                                        </a>
                                    </div>
                                <?php } ?>
                                <div class="account_popup_container d-inline-block">
                                    <strong>Created By: </strong>
                                    <?php $online_date = online_status_true($exam_view[0]->userid); ?>
                                    <span class="table-image d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                          title="<?= other_user_fullname($exam_view[0]->userid); ?> (Currently: <?= $online_date[1] ?>)">
                                        <?php if (other_user_profile_picture($exam_view[0]->userid)) { ?>
                                            <img height="22" width="22" class="profile-image-active-tiny"
                                                 src="<?= other_user_profile_picture($exam_view[0]->userid); ?>">
                                        <?php } else {
                                            ?><span class="table-name d-inline-block"><?php
                                            echo other_user_firstname($exam_view[0]->userid)[0] . other_user_lastname($exam_view[0]->userid)[0];
                                            ?></span><?php
                                        } ?>
                                    </span>
                                    <span class="d-inline-block"><?= other_user_fullname($exam_view[0]->userid); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php if ( current_user_can('administrator') ) { ?>
                            <form method="post" class="form-inline">
                                <button  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="btn btn-danger waves-effect waves-light" type="submit" name="exam_bin" value="<?= $exam_view[0]->displayid; ?>">
                                    <i class="mdi mdi-trash-can d-block font-size-16"></i>
                                </button>
                            </form>
                        <?php } ?>
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
                            <i data-feather="settings"></i>Settings
                        </a>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </div>

    <div class="tab-content my-account-page section-block-p0 mb-4">
        <?php include 'layouts/includes/renewals/renewals_overview.php'; ?>
        <?php if (doif_coopereditoronly_query()) { ?>
            <?php include 'layouts/includes/renewals/renewals_edit_exam.php'; ?>
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

