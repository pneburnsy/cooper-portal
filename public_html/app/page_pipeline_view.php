<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';

// HEADER
$page = 'View Pipeline';
$breadcrumbtitle = 'View Pipeline';
include 'layouts/header.php';

// IMPORT QUERIES
if ($_GET['pipeline_id'] == '2') {
    doif_cooperadminonly_query(true, 'pipeline_2');
} elseif ($_GET['pipeline_id'] == '3') {
    doif_cooperadminonly_query(true, 'pipeline_3');
} else {
    doif_cooperadminonly_query(true, 'pipeline_1');
}

pipeline_view(false);
pipeline_edit(false);
pipeline_delete(false);

notes_view(false);
notes_add(false);
notes_reminder_add(false);
notes_delete(false);
notes_complete(false);

accounts_team_distinct(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php
if (!$pipeline_view[0]->displayid) {
    include 'layouts/security/security_access_to_page.php';
} else {
    if ($_GET['pipeline_id'] == '2') {
        view_page_back('Solutions Pipeline', '/app/page_pipeline.php?pipeline_id=2');
    } elseif ($_GET['pipeline_id'] == '3') {
        view_page_back('Rental Pipeline', '/app/page_pipeline.php?pipeline_id=3');
    } else {
        view_page_back('Specialised Pipeline', '/app/page_pipeline.php?pipeline_id=1');
    }
    accounts_team_single($pipeline_view[0]->clientaccount, false);
    ?>
    <div class="card card-top section-block-mb2 section-block-p0 mb-4">
        <div class="card-body ">
            <div class="row">
                <div class="col-sm order-2 order-sm-1">
                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                        <div class="flex-shrink-0">
                            <div class="avatar-xl me-3">
                                <span class="profile-image-big"><?= $pipeline_view[0]->name[0]; ?></span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div>
                                <h5 class="font-size-16 mb-1">
                                    <span class="mb-3 me-3" style="display: inline-block;">
                                        <?= $pipeline_view[0]->name ?>
                                    </span>
                                    <div class="solo mb-3" style="display: inline-block;">
                                        <?php if ($pipeline_view[0]->status == 1) { ?>
                                            <div class="deal-status-complete">
                                                Completed
                                            </div>
                                        <?php } elseif ($pipeline_view[0]->status == 2) { ?>
                                            <div class="deal-status-lost">
                                                Lost
                                            </div>
                                        <?php } else { ?>
                                            <div class="deal-status-pending">
                                                Open
                                            </div>
                                        <?php } ?>
                                    </div>
                                </h5>
                                <div class="mb-3">

                                    <div class="desc-box mb-3">
                                        <strong class="mb-1">Description:</strong>
                                        <div><?= $pipeline_view[0]->desc ?></div>
                                    </div>

                                    <div style="margin-right: 12px;">
                                        <strong>Close Date: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;">
                                            <?php if ($pipeline_view[0]->close_date) {
                                                echo formatted_date($pipeline_view[0]->close_date);
                                            } else {
                                                echo '<span class="placeholder">Not Set</span>';
                                            }?>
                                        </span>
                                    </div>

                                    <div style="margin-right: 12px;" class="mb-2">
                                        <strong>Completed Date: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;">
                                            <?php
                                            // Days to close
                                            $creationDate  = new DateTime($pipeline_view[0]->creation_date);
                                            $completedDate = new DateTime($pipeline_view[0]->completed_date);
                                            $interval = $creationDate->diff($completedDate);
                                            ?>
                                            <?php if ($pipeline_view[0]->completed_date) {
                                                echo formatted_date($pipeline_view[0]->completed_date) . ' <span>(Took ' . $interval->days . ' Day(s) to Close)</span>';
                                            } else {
                                                echo '<span class="placeholder">In Progress</span>';
                                            }?>
                                        </span>
                                    </div>

                                    <div style="margin-right: 12px;">
                                        <strong>Manufacturer: </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= $pipeline_view[0]->make; ?></span>
                                    </div>

                                    <div style="margin-right: 12px;">
                                        <strong>Quote (Estimated): </strong>
                                        <span class=" text-muted font-size-13" style="margin-left: 3px;"><?= form_currency($pipeline_view[0]->total_quote) ?></span>
                                    </div>

                                    <div style="margin-right: 12px;">
                                        <strong style="display: inline-block;" class="me-2">Priority: </strong>
                                        <div style="display: inline-block;" class="badge-priority
                                            <?php if ($pipeline_view[0]->priority == 4) {
                                            echo 'priority-4';
                                        } elseif ($pipeline_view[0]->priority == 3) {
                                            echo 'priority-3';
                                        } elseif ($pipeline_view[0]->priority == 2) {
                                            echo 'priority-2';
                                        } elseif ($pipeline_view[0]->priority == 1) {
                                            echo 'priority-1';
                                        } else {
                                            echo 'priority';
                                        } ?>
                                        ">
                                            <i data-feather="flag" class="priority-flag"></i>
                                            <?php if ($pipeline_view[0]->priority == 4) {
                                                echo 'Urgent';
                                            } elseif ($pipeline_view[0]->priority == 3) {
                                                echo 'High';
                                            } elseif ($pipeline_view[0]->priority == 2) {
                                                echo 'Medium';
                                            } elseif ($pipeline_view[0]->priority == 1) {
                                                echo 'Low';
                                            } else {
                                                echo 'None';
                                            } ?>
                                        </div>
                                    </div>

                                    <div style="max-width:400px;">
                                        <strong>Probability: </strong>
                                        <div>
                                            <div class="d-flex text-center">
                                                <div class="percentage-block">
                                                    <div class="percentage-block-inner" style="width:<?= $pipeline_view[0]->percentage ?>%;"></div>
                                                </div>
                                                <span class="ms-2" style="font-size: 10px;"><?= $pipeline_view[0]->percentage ?>%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="margin-right: 12px; opacity: 0.3;" class="mt-2">
                                        <small class=" text-muted font-size-13"><strong>Created by: </strong><?=other_user_fullname($pipeline_view[0]->user_id)?> on <?= formatted_date($pipeline_view[0]->creation_date) ?></small>
                                    </div>

                                </div>
                                <div class="region_profile d-inline-block" style="margin-right:12px;">
                                    <strong>Region: </strong>
                                    <?= get_region_flag($pipeline_view[0]->region) ?>
                                </div>
                                <?php if ( $pipeline_view[0]->clientaccount ) { ?>
                                    <div class="account_popup_container d-inline-block" style="margin-right: 12px;">
                                        <strong>Account: </strong>
                                        <a href="/app/page_accounts_view?displayid=<?= $accounts_team_single[0]->displayid; ?>">
                                            <span class="d-inline-block account_icon_full text-muted font-size-13" style="margin-left: 3px; background-color:rgba( <?= $accounts_team_single[0]->accountarray; ?> , 0.5)"><?= $accounts_team_single[0]->accountname; ?></span>
                                        </a>
                                    </div>
                                <?php } ?>
<!--                                --><?php
//                                print_r($pipeline_view);
//                                ?>
                                <div class="account_popup_container d-inline-block" style="margin-right: 12px;">
                                    <strong>Assigned To: </strong>
<!--                                    --><?php //$online_date = online_status_true($pipeline_view[0]->user_id); ?>
                                    <?php if (!empty($pipeline_view[0]->assignee)) { ?>
                                        <?php $online_date = online_status_true($pipeline_view[0]->assignee); ?>
                                        <span class="table-image d-inline-block" data-bs-toggle="tooltip" style="top:3px !important;" data-bs-placement="top" title="<?= other_user_fullname($pipeline_view[0]->assignee); ?> (Currently: <?= $online_date[1] ?>)">
                                            <span class="table-name d-inline-block"><?php
                                                echo other_user_firstname($pipeline_view[0]->assignee)[0] . other_user_lastname($pipeline_view[0]->assignee)[0];
                                                ?>
                                            </span>
                                        </span>
                                        <span class="d-inline-block"><?= other_user_fullname($pipeline_view[0]->assignee); ?></span>
                                    <?php } else { ?>
                                        <span class="table-image d-inline-block" data-bs-toggle="tooltip" style="top:3px !important; background-color:#cacaca;" data-bs-placement="top" title="No User Currently Assigned">
                                        </span>
                                        <span class="d-inline-block">No User Assigned</span>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <?php if ( current_user_can('administrator') ) { ?>
                            <form method="post" class="form-inline">
                                <button  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="btn btn-danger waves-effect waves-light" type="submit" name="pipeline_delete" value="<?= $pipeline_view[0]->id; ?>">
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
                <li class="nav-item account-icon">
                    <a class="nav-link px-3 <?php if ($_GET['tab'] == 'pipeline_settings') { echo 'active'; } ?>" data-bs-toggle="tab" href="#pipeline_settings" role="tab">
                        <i data-feather="settings"></i>Settings
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content my-account-page section-block-p0 mb-4">
        <?php include 'layouts/includes/pipeline/pipeline_overview.php'; ?>
        <?php include 'layouts/includes/pipeline/pipeline_edit.php'; ?>
    </div>

    <?php
}
?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>