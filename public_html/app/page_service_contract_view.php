<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';

// HEADER
$page = 'View Service Contract';
$breadcrumbtitle = 'View Service Contract';
include 'layouts/header.php';

// IMPORT QUERIES
doif_cooperonly(true, 'service');

service_view(false);
service_send(false);
service_edit(false);
service_bin(false);
service_settings_edit(false);
service_submissions(false);
service_schedule(false);
service_schedule_delete(false);
service_team_table_hours_delete(false);

accounts_team_distinct(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php

if (!$service_view[0]->displayid) {
    include 'layouts/security/security_access_to_page.php';
} else {
    ?>
    <?= view_page_back('Service Contracts', '/app/page_service_contract.php'); ?>
    <?php accounts_team_single($service_view[0]->clientaccount, false); ?>
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
                                <h5 class="font-size-16 mb-1"><?= $service_view[0]->man_serial_no . ' (' . $service_view[0]->make . ' ' . $service_view[0]->model . ')'; ?></h5>
                                <p class="text-muted font-size-13">
                                    <?php
                                    $current_hours = hours_until_service($service_view[0]->serviceduein, $service_view[0]->last_odo_hours, $service_view[0]->lastest_odo_hours);
                                    $last_service_date = $service_view[0]->last_odo_date;
                                    // GLOBAL
                                    global $service_status;
                                    global $renewal_date;
                                    // FUNCTIONS
                                    //hours_due_in($current_hours, $last_service_date);
                                    $duedate = $service_view[0]->due_odo_date;
                                    $lastserviceddate = $service_view[0]->last_odo_date;
                                    ?>
                                    <span style="position:relative;top:2px;">
                                        <strong>Due In (Hrs):</strong> <?= $current_hours ?>
                                    </span>
                                    <br>
                                    <span style="position:relative;top:2px;">
                                        <strong>Due Date:</strong> <?= formatted_renewal_date($duedate); ?>
                                    </span>
                                    <br>
                                    <span style="position:relative;top:2px;">
                                        <strong>Last Serviced:</strong> <?= formatted_renewal_date($lastserviceddate); ?>
                                    </span>
                                </p>
                                <div class="mb-3">
                                    <div style="margin-right: 12px;">
                                        <strong>Make: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $service_view[0]->make; ?></span>
                                    </div>
                                    <div style="margin-right: 12px;">
                                        <strong>Model: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $service_view[0]->model; ?></span>
                                    </div>
                                    <div style="margin-right: 12px;">
                                        <strong>Fleet Number: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $service_view[0]->fleet_no; ?></span>
                                    </div>
                                    <div style="margin-right: 12px;">
                                        <strong>Serial Number: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $service_view[0]->man_serial_no; ?></span>
                                    </div>
                                    <div style="margin-right: 12px;">
                                        <strong>Engine Serial Number: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $service_view[0]->eng_serial_no; ?></span>
                                    </div>
                                    <div style="margin-right: 12px;">
                                        <strong>Equipment Location: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;">
                                            <?= $service_view[0]->location . ' (' . $service_view[0]->postcode . ')' ?>
                                            <a target="_blank" class="get_directions" href="https://www.google.com/maps/place/<?= $service_view[0]->postcode ?>">
                                                Get Directions
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="region_profile d-inline-block" style="margin-right: 12px;">
                                    <strong>Region: </strong>
                                    <?= get_region_flag($service_view[0]->region) ?>
                                </div>
                                <?php if ( $service_view[0]->clientaccount ) { ?>
                                    <div class="account_popup_container d-inline-block" style="margin-right: 12px;">
                                        <strong>Account: </strong>
                                        <a href="/app/page_accounts_view?displayid=<?= $accounts_team_single[0]->displayid; ?>">
                                            <span class="d-inline-block account_icon_full text-muted font-size-13" style="margin-left: 3px; background-color:rgba( <?= $accounts_team_single[0]->accountarray; ?> , 0.5)"><?= $accounts_team_single[0]->accountname; ?></span>
                                        </a>
                                    </div>
                                <?php } ?>
                                <div class="account_popup_container d-inline-block">
                                    <strong>Created By: </strong>
                                    <?php $online_date = online_status_true($service_view[0]->userid); ?>
                                    <span class="table-image d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                          title="<?= other_user_fullname($service_view[0]->userid); ?> (Currently: <?= $online_date[1] ?>)">
                                        <?php if (other_user_profile_picture($service_view[0]->userid)) { ?>
                                            <img height="22" width="22" class="profile-image-active-tiny"
                                                 src="<?= other_user_profile_picture($service_view[0]->userid); ?>">
                                        <?php } else {
                                            ?><span class="table-name d-inline-block"><?php
                                            echo other_user_firstname($service_view[0]->userid)[0] . other_user_lastname($service_view[0]->userid)[0];
                                            ?></span><?php
                                        } ?>
                                    </span>
                                    <span class="d-inline-block"><?= other_user_fullname($service_view[0]->userid); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php if ( current_user_can('administrator') ) { ?>
                            <form method="post" class="form-inline">
                                <button  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="btn btn-danger waves-effect waves-light" type="submit" name="service_bin" value="<?= $service_view[0]->displayid; ?>">
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
                        <a class="nav-link px-3 <?php if ($_GET['tab'] == 'service_hours_submissions') { echo 'active'; } ?>" data-bs-toggle="tab" href="#service_hours_submissions" role="tab">
                            <i data-feather="edit-3"></i>ODO Submission
                        </a>
                    </li>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3 <?php if ($_GET['tab'] == 'service_schedule') { echo 'active'; } ?>" data-bs-toggle="tab" href="#service_schedule" role="tab">
                            <i data-feather="calendar"></i>Schedule Service
                        </a>
                    </li>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3 <?php if ($_GET['tab'] == 'service_submissions') { echo 'active'; } ?>" data-bs-toggle="tab" href="#service_submissions" role="tab">
                            <i data-feather="check-square"></i>Complete Service
                        </a>
                    </li>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3 <?php if ($_GET['tab'] == 'service_status') { echo 'active'; } ?>" data-bs-toggle="tab" href="#service_status" role="tab">
                            <i data-feather="tool"></i>Current Service Settings
                        </a>
                    </li>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3 <?php if ($_GET['tab'] == 'service_hours_history') { echo 'active'; } ?>" data-bs-toggle="tab" href="#service_hours_history" role="tab">
                            <i data-feather="list"></i>History
                        </a>
                    </li>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3 <?php if ($_GET['tab'] == 'service_settings') { echo 'active'; } ?>" data-bs-toggle="tab" href="#service_settings" role="tab">
                            <i data-feather="settings"></i>Settings
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="tab-content my-account-page section-block-p0 mb-4">
        <?php include 'layouts/includes/service/service_overview.php'; ?>
        <?php if (doif_coopereditoronly_query()) { ?>
            <?php include 'layouts/includes/service/service_hours_submissions.php'; ?>
            <?php include 'layouts/includes/service/service_submissions.php'; ?>
            <?php include 'layouts/includes/service/service_status.php'; ?>
            <?php include 'layouts/includes/service/service_hours_history.php'; ?>
            <?php include 'layouts/includes/service/service_schedule.php'; ?>
            <?php include 'layouts/includes/service/service_edit.php'; ?>
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

