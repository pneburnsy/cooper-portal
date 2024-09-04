<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';
// PAGE

// HEADER
$page = 'ODO Submissions';
$breadcrumbtitle = 'Service Contracts';
$breadcrumbchild = 'ODO Submissions';
include 'layouts/header.php';
include 'layouts/page_title.php';

// CHECK USER FOR ACCOUNT DISPLAYID
function service_security() {
    global $wpdb;
    global $table_name;
    $table = $wpdb->prefix . 'service';
    // ------ VARIABLES ------
    if (doif_cooperonly_query()) {
        if ($_GET['clientaccount']) {
            $clientaccount = safestring($_GET['clientaccount']);
            $run_statement = true;
        }
        else {
            $clientaccount = safestring(current_user_account());
            $run_statement = true;
        }
    } else {
        if (current_user_fleet_manager(current_user_displayid(), current_user_account()) || current_user_fleet_contact(current_user_id(), current_user_account(), current_user_email())) {
            $clientaccount = safestring(current_user_account());
            $run_statement = true;
        } else {
            $clientaccount = NULL;
            $run_statement = false;
        }
    }

    // ------ QUERY ------
    if ($run_statement) {
        global $service_check;
        $service_check = $wpdb->get_results($wpdb->prepare("SELECT * FROM `$table` WHERE status = 0 AND clientaccount = '%s'", $clientaccount));
    }
    // ------ MESSAGE/ACTION ------
    global $security_status;
    if ($service_check || current_user_fleet_contact(current_user_id(), current_user_account(), current_user_email())) {
        $security_status = 'true';
    } else {
        $security_status = 'false';
    }

}
service_security();

// GET SERVICE ODO SUBMISSION LIST
function service_clientaccount() {
    global $wpdb;
    global $table_name;
    $table = $wpdb->prefix . 'accounts';
    // ------ VARIABLES ------
    if (isset($_GET['clientaccount']) && current_user_can('administrator')) {
        $currentaccount = safestring($_GET['clientaccount']);
    } else {
        $currentaccount = safestring(current_user_account());
    }
    // ------ QUERY ------
    global $service_account;
    $service_account = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$table` WHERE displayid = '%s'", $currentaccount));
    // ------ MESSAGE/ACTION ------
    if ($service_account) {
        return true;
    } else {
        return false;
    }
}
service_clientaccount();

global $service_account;
$firstname = other_user_firstname(other_convert_displayid($service_account->fleetmanager));
$lastname = other_user_lastname(other_convert_displayid($service_account->fleetmanager));
$fleetemail = other_user_email(other_convert_displayid($service_account->fleetmanager));
service_hour_submission_clientform(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php
if ($security_status == 'false') {
    include 'layouts/security/security_access_to_page.php';
} else { ?>
    <?php if (isset($_GET['clientaccount']) && current_user_can('administrator')) { ?>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="admin_message">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                             <h5 class="mt-2" style="color:#fff;"><span style="font-weight:normal;">Currently Editing: </span><?= $service_account->accountname ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-xl-9 col-md-12 ">
            <div>
                <?php if ( $service_check ) { ?>
                    <div>
                        <div>
                            <form class="add_week" id="add_week" method="post" onSubmit="window.location.reload()">
                                <?php $loopnumber = 0;
                                $uptodate = 0;?>
                                <?php for($j = 0; $j < count($service_check); $j++) { ?>

                                    <?php
                                    // LASTEST
                                    $timestamp = strtotime($service_check[$j]->lastest_odo_date);
                                    $lastest_week_number = date("W", $timestamp);
                                    $lastest_year_number = date("Y", $timestamp);
                                    $lastest_formatted_date = "$lastest_week_number $lastest_year_number";
                                    // TODAY
                                    $timestamp_today = strtotime('today');
                                    $today_week_number = date("W", $timestamp_today);
                                    $today_year_number = date("Y", $timestamp_today);
                                    $today_formatted_date = "$today_week_number $today_year_number";

                                    if ($lastest_formatted_date != $today_formatted_date) { ?>

                                        <div class="service_submission_block_parent group content_block card increase-br card-top section-block-p0 mb-4" id="content_block_<?= $j ?>">
                                            <?php $loopnumber; ?>
                                            <div class="row">
                                                <div class="col-xl-6 col-md-12 ">

                                                    <div class="card_service_block_area">
                                                        <span class="card-number"><?= $j + 1 ?></span>
                                                        <h4 class="card-title" style="color: #090d2a;"><?= $service_check[$j]->fleet_no ?> (<?= $service_check[$j]->make . ' ' . $service_check[$j]->man_serial_no  ?>)</h4>
                                                        <p class="card-title-desc submission" style="color:#090d2a;"><strong>Last Submission:</strong> <?= $service_check[$j]->lastest_odo_hours . ' Hrs (Submitted: ' . formatted_renewal_date($service_check[$j]->lastest_odo_date) . ')' ?></p>
                                                    </div>
                                                    <div class="group_content">
                                                        <p style="margin-bottom:0;"><strong>Serial Number: </strong><?= $service_check[$j]->man_serial_no ?></p>
                                                        <p style="margin-bottom:0;"><strong>Make: </strong><?= $service_check[$j]->make ?></p>
                                                        <p style="margin-bottom:0;"><strong>Model: </strong><?= $service_check[$j]->model ?></p>
                                                        <a target="_blank" class="btn btn-primary waves-effect waves-light" href="https://portal.cooperhandling.com/app/page_service_contract_view.php?displayid=<?= $service_check[$j]->displayid ?>">View Contract</a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-12 ">
                                                    <?php service_hour_submissions($service_check[$j]->lastest_odo_date, $service_check[$j]->lastest_odo_hours, $loopnumber, $service_check[$j]->displayid, 'true'); ?>
                                                    <?php $loopnumber++; ?>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } else {
                                        $uptodate++;
                                    } ?>

                                <?php } ?>

                                <?php if ($uptodate >= 1 ) { ?>
                                    <div class="group content_block card increase-br card-top section-block-p0 mb-4" id="content_block_uptodate">
                                        <span style="border-radius:10px;padding: 15px;text-align:center;background-color: rgb(40 168 29 / 25%)!important;color: #54a963;"><?= $uptodate ?> other contracts are also up-to-date.</span>
                                    </div>
                                <?php } ?>

                            </form>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="card-body faq-block" style="text-align:center;">
                        <div class="mb-2">Unfortunately this is not a valid ODO Submissions ID, if you think this is an error, please contact Cooper Handling directly. We apologise for any inconvenience caused.</div>
                        <div class="mt-2">Regards</div>
                        <div>Cooper Handling</div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-xl-3 col-md-12">
            <div class="card card-top section-block-p0 mb-4">
                <div class="card-body">
                    <h4 class="mb-4">Submit Latest ODO Readings</h4>
                    <p class="mb-4">Please stay up-to-date with your submissions to ensure your equipment stays within its service schedule. <strong>If your fleet managers details need updating please contact us.</strong></p>
                    <p><strong>Fleet Manager: </strong><?= $firstname . ' ' . $lastname . ' (' . $fleetemail . ')'?></p>
                    <span class="disclaimer" style="display:block;text-align:left;">If a service is missed because you have failed to upload the latest readings you could be liable for any repair costs.</span>
                    <button form="add_week" type="submit" name="service_hour_submission_clientform" class="btn btn-primary waves-effect waves-light" style="margin-top:20px;margin-bottom:10px;">Submit Hours</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>
