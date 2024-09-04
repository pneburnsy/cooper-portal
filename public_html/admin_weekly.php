<?php

if ($_SERVER['REMOTE_ADDR'] != $_SERVER['SERVER_ADDR']) {
    exit("Unauthorized access.");
}

/*
 * -------------------------- CRON JOB --------------------------
 *
 * DESCRIPTIONS
 * Weekly CRON job for admin reminders - handles emailing admins with reminders of all outstanding/overdue jobs.
 *
 * FUNCTIONS
 * - Email admins from 'Admin Options' with a Overdue update.
 *
 */

// --------- SECURITY ---------
//$passcode = 'HSADC7HBJ3RE76SDVGYSFVGHSD64Q3G7364923U4GVRBWUESFC';
//if ($_GET['passcode'] != $passcode) {
//    exit;
//}

require_once( 'wp-load.php' );
global $wpdb;
include 'app/layouts/database/overdue/overdue_menu.php';

// ------ Get Counts ------
maintenance_overdue_count();
rentals_overdue_count();
exam_overdue_count();
service_overdue_count();
// Assign to Variables
$maintenance = array (
    'label' => 'Maintenance Contracts',
    'value' => $maintenance_overdue_count[0]->total
);
$rentals = array(
    'label' => 'Rental Equipment',
    'value' => $rentals_overdue_count[0]->total
);
$exam = array(
    'label' => 'Thorough Examinations',
    'value' => $exam_overdue_count[0]->total
);
$service = array(
    'label' => 'Service Contracts',
    'value' => $service_overdue_count[0]->total
);

// Group All Reminders
$reminders = array(
    $maintenance,
    $rentals,
    $exam,
    $service,
);
// print_r($reminders);


// ------ Get Email Admins ------
$admin_table = $wpdb->prefix . 'admin_options';
$admin_options = $wpdb->get_results("SELECT portaladminemail FROM `$admin_table`");
$email_list = explode(",", $admin_options[0]->portaladminemail);
// print_r($email_list);


// ------ Send Emails ------
include 'app/layouts/database/overdue/email/admin_weekly_outstanding.php';
for ($i = 0; $i < count($email_list); $i++) {
    $current_email = $email_list[$i];
    admin_outstanding($current_email, $reminders);
}